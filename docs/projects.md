# Projects

## List projects

```php
// List all projects
$projects = Basecamp::projects()->index();

// List archived projects
$projects = Basecamp::projects()->archived();

// List trashed projects
$projects = Basecamp::projects()->trashed();
```

## Show a project

```php
$project = Basecamp::projects()->show($id);

// Dock items
$project->campfire();
$project->messageBoard();
$project->todoset();
$project->schedule();
$project->questionnaire();
$project->vault();
$project->inbox();

// Client items
$project->clientApprovals();
$project->clientCorrespondences();

// Admin items
$project->messageTypes();
$project->webhooks();
```

## Create a new project

```php
$project = Basecamp::projects()->store([
    'name' => 'Marketing Campaign',
    'description' => 'For Client: Xyz Corp Conference',
]);
```

## Update a project

```php
$project->update([
    'name' => 'Marketing Campaign for Xyz Corp',
    'description' => '2016-2017 Strategy',
]);

// Or update with ID.
Basecamp::projects()->update($id, [...]);
```

## Delete a project

```php
$project->destroy();

// Or destroy with ID.
Basecamp::projects()->destroy($id);
```

