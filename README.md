# Y42 Task

## Description
- Parse `request-data.json` into the query similar to `result.sql`.

Inside `request-data.json` you have two properties `nodes` and `edges`, `nodes` contains all the required information to apply the transformation into Table/Query and `edges` represents how they are linked together. In each node there is a property `transformObject` which is different for each `type`
There are 5 different types of nodes used in this request

	- INPUT		-> it contains information about table and which fields to select from original table. 
	- FILTER	-> contains SQL "where" settings 
	- SORT		-> contains SQL "order by" settings 
	- TEXT_TRANSFORMATION	    -> contains information about applying some text SQL function on any column. For example UPPER, LOWER (see the digram for actual use case)
	- OUTPUT	-> contains SQL "limit" settings

## Pre-install
The project uses the below stack so make sure that your machine is installing it.
* PHP 8.0.9 or higher

## Installation
### Go the main project path
Run
```
composer install
```

## To start the transformation process
Run the following command from your terminal
```
php index.php
```

## Response
```json
{
    "success": "WITH A AS (SELECT `id`,`name`,`age` FROM `users`),B AS (SELECT `id`, `name`, `age` FROM A WHERE age > 18),C AS (SELECT `id`, `name`, `age` FROM B ORDER BY `age` ASC, `name` DESC),D AS (SELECT `id`, UPPER(`name`) as `name`, `age` FROM `C`),E AS (SELECT `id`, `name`, `age` FROM `D` LIMIT 100 OFFSET 0) SELECT * from E"
}
```
## UML Diagram of App
![UML Diagram](images/diagram.png?raw=true)

## Sequence Diagram of App
![Sequence Diagram](images/sequence-diagram.png?raw=true)

## Bonus Points
> Extendable structure which allows to add more types easily in the future.

![Code Structure](images/nodes.png?raw=true)

![Code Structure](images/transformationObject.png?raw=true)

I have designed my solution so that it gives us the flexibility to add new nodes types with its custom transformationObject structure without any need to change in the main class
I followed the second SOLID Principle "O for Open for extension closed form modification".

### To create a new node type you have 
* You have to create a new directory under `app/NodeTypes`.
* Create a new transformation object class and define its attribute
```php
use App\Abstracts\AbstractTransformObject;

class INPUT_TRANSFORM_OBJECT_NAME extends AbstractTransformObject
{
    
}
```

### Create a new class for the new node
```php
use App\Abstracts\AbstractType;

class INPUT_TYPE_NAME extends AbstractType
{
    protected INPUT_TRANSFORMATION_OBJECT $transformObject;

    public function toQuery(): string
    {
        // This method should return the query for the new input type.
        return '';
    }
}
```
----
> Suggestion on how to validate the columns used inside the nodes.

![Code Structure](images/schemaValidation.png?raw=true)

I have used `opis/json-schema` php library to validate the node schema for each type. To create a new schema validation
Create a new schema Validation file inside the directory of the new node type 
```php
use App\Abstracts\AbstractSchemaValidation;

class InputSchemaValidation extends AbstractSchemaValidation
{
    protected array $schema = [
        //Set the validation rules here inside the schema property array.
    ];
}
```

### Add new created classes to the IOC config file
for the application IOC to know about the new created classes you have to update the `config/ioc.php` file with the new added NodeType and ValidationSchema classes

```php
'NodeType' => function($app, $params) {
    // ...
    case 'TEXT_TRANSFORMATION':
        $params['transformObject'] = $serializer->deserialize(json_encode(['items' => $transformObject]), TextTransformationTransformObjectCollection::class, 'json');
        return $app->make(TextTransformNodeType::class, $params);
    
    // Append a new case with your new node information
}
```

```php
'ValidationSchema' => function($app, $params) {    
        // ...
        'REQUEST_SCHEMA' => new RequestSchemaValidation(),            
        // Append a new case with your new validation schema information
}
```