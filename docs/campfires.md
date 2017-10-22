# Campfires

## List all projects campfires

```php
$campfires = Basecamp::campfires()->index();
```

## Show a project campfire

```php
$campfire = Basecamp::projects()->show($projectId)->campfire()->show();
```

## Get a campfire lines

```php
$lines = $campfire->lines();
```

## Get a single campfire line

```php
$line = $campfire->line($id);
```

## Create a campfire line

```php
$line = $campfire->storeLine('Hello!');
```
