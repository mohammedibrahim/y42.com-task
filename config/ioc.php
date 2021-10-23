<?php

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;

use App\NodeTypes\Input\InputNodeType;
use App\NodeTypes\Filter\FilterNodeType;
use App\NodeTypes\Output\OutputNodeType;
use App\NodeTypes\Sort\SortNodeType;
use App\NodeTypes\TextTransformation\TextTransformNodeType;

use App\NodeTypes\Input\InputSchemaValidation;
use App\NodeTypes\Output\OutputSchemaValidation;
use App\NodeTypes\Sort\SortSchemaValidation;
use App\NodeTypes\Filter\FilterSchemaValidation;
use App\Validation\RequestSchemaValidation;
use App\NodeTypes\TextTransformation\TextTransformationSchemaValidation;

use App\Exceptions\SchemaNotFoundException;
use App\Exceptions\NodeTypeNotFoundException;

use App\NodeTypes\Input\InputTransformObject;
use App\NodeTypes\Output\OutputTransformObject;
use App\NodeTypes\Sort\SortTransformObjectCollection;
use App\NodeTypes\Filter\FilterTransformObject;
use App\NodeTypes\TextTransformation\TextTransformationTransformObjectCollection;

use Illuminate\Contracts\Container\Container  as ContainerInterface;
use Illuminate\Container\Container;

use App\NodeTypes\Sort\SortTransformObject;
use App\NodeTypes\TextTransformation\TextTransformationTransformObject;
$iocContainer = new Container();

return [
    'bindings' => [
        Serializer::class => fn($app) => new Serializer(
            [new ObjectNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()],
        ),

        'NodeType' => function($app, $params) {
            ['type' => $type, 'transformObject' => $transformObject] = $params;

            $serializer = $app->make(Serializer::class);
            
            switch ($type) {
                case 'INPUT':
                    $params['transformObject'] = $serializer->deserialize(json_encode($transformObject), InputTransformObject::class, 'json');
                    return $app->make(InputNodeType::class, $params);
                case 'OUTPUT':
                    $params['transformObject'] = $serializer->deserialize(json_encode($transformObject), OutputTransformObject::class, 'json');
                    return $app->make(OutputNodeType::class, $params);
                case 'SORT':
                    $items = $serializer->deserialize(json_encode($transformObject), SortTransformObject::class.'[]', 'json');
                    $params['transformObject'] = $app->make(SortTransformObjectCollection::class, ['items' => $items]);
                    return $app->make(SortNodeType::class, $params);
                case 'FILTER':
                    $params['transformObject'] = $serializer->deserialize(json_encode($transformObject), FilterTransformObject::class, 'json');
                    return $app->make(FilterNodeType::class, $params);
                case 'TEXT_TRANSFORMATION':
                    $items = $serializer->deserialize(json_encode($transformObject), TextTransformationTransformObject::class.'[]', 'json');
                    $params['transformObject'] = $app->make(TextTransformationTransformObjectCollection::class, ['items' => $items]);
                    return $app->make(TextTransformNodeType::class, $params);
                default:
                    throw new NodeTypeNotFoundException();
            }
        },

        'ValidationSchema' => function($app, $params) {
            ['type' => $type] = $params;

            return match ($type) {
                'INPUT' => new InputSchemaValidation(),
                'OUTPUT' => new OutputSchemaValidation(),
                'SORT' => new SortSchemaValidation(),
                'FILTER' => new FilterSchemaValidation(),
                'TEXT_TRANSFORMATION' => new TextTransformationSchemaValidation(),
                'REQUEST_SCHEMA' => new RequestSchemaValidation(),
                default => throw new SchemaNotFoundException(),
            };
        },

        ContainerInterface::class => fn($app) => $iocContainer
    ]
];