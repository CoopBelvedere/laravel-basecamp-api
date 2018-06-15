# Campfires

## List all projects campfires

```php
$campfires = Basecamp::campfires()->index();
```

## Show a project campfire

```php
$campfire = Basecamp::campfires($projectId)->show($campfireId);

// You can also get the campfire dock item of a project, and it will create
// a basic Campfire object.
$project = Basecamp::projects()->show($projectId);
$campfire = $project->campfire();

// But the dock item doesn't have all campfire properties, so you can make
// a second API call to get more details about the campfire, if necessary.
$campfire = $project->campfire()->show();
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
