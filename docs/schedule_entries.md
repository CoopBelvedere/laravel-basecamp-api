# Schedule entries

## List schedule entries

```php
// List all schedule entries
$entries = $project->schedule()->entries()->index();

// List archived schedule entries
$entries = $project->schedule()->entries()->archived();

// List trashed schedule entries
$entries = $project->schedule()->entries()->trashed();
```

### Show a schedule entry

```php
$entry = $project->schedule()->entries()->show($id);
```

### Create a new schedule entry

```php
$entry = $project->schedule()->entries()->store([
    'summary' => 'Important meeting',
    'starts_at' => '2017-10-28T00:00:00Z',
    'ends_at' => '2017-10-28T02:00:00Z',
]);
```

### Update a schedule entry

```php
$entry->update([
    'summary' => 'Important meeting',
    'starts_at' => '2017-10-28T00:00:00Z',
    'ends_at' => '2017-10-28T02:00:00Z',
]);

// Or update with ID.
$project->schedule()->entries()->update($id, [...]);
```

### Delete a schedule entry

```php
$entry->destroy();

// Or destroy with ID.
$project->schedule()->entries()->destroy($id);
```
