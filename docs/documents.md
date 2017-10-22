# Documents

## List documents

```php
$documents = $project->vault()->documents()->index();
```

## Show a document

```php
$document = $project->vault()->document()->show($id);
```

## Create a new document

```php
$document = $project->vault()->documents()->store([
    'title' => 'New Hire Info',
    'content' => '<div><strong>Getting started</strong></div>',
    'status' => 'active',
]);
```

## Update a document

```php
$document->update([
    'title' => 'New Hire Information',
    'content' => '<div><strong>Let\'s get started</strong></div>',
]);

// Or update with ID.
$project->vault()->documents()->update($id, [...]);
```

## Delete a document

```php
$document->destroy();

// Or destroy with ID.
$project->vault()->documents()->destroy($id);
```
