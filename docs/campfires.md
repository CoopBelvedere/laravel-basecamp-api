# Campfires

## List all projects campfires

```
$campfires = Basecamp::campfires()->index();
```

## Show a project campfire

```
$campfire = Basecamp::projects()->show($projectId)->campfire()->show();
```

## Get a campfire lines

```
$lines = $campfire->lines();
```

## Get a single campfire line

```
$line = $campfire->line($id);
```

## Create a campfire line

```
$line = $campfire->storeLine('Hello!');
```
