# Forwards

## List forwards

```php
$forwards = $project->inbox()->forwards()->index();
```

## Get a forward

```php
$forward = $project->inbox()->forwards()->show($id);
```

## Delete a forward

```php
$forward->destroy();

// Or destroy with ID
$project->inbox()->forwards()->destroy($id);
```
