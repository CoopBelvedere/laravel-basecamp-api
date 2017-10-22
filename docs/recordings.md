# Recordings

## List recordings

You can list resources like `Comment`, `Document`, `Message`,
`Question::Answer`, `Schedule::Entry`, `Todo`, `Todolist` or `Upload`
in all your projects.

```php
$recordings = Basecamp::recordings()->index('Comment', [
    // Optional parameters
    'bucket' => $project->id,
    'status' => 'active',
    'sort' => 'created_at',
    'direction' => 'desc',
]);
```

## Delete a recording

```php
$recording->destroy();

// Or destroy with ID
Basecamp::recordings($project->id)->destroy($id);
```
