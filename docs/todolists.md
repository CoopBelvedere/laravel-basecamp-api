# To-do Lists

## List to-do lists

```
// List all to-do lists
$todoLists = $project->todoSet()->todoLists()->index();

// List archived to-do lists
$projects = $project->todoSet()->todoLists()->archived();

// List trashed to-do lists
$projects = $project->todoSet()->todoLists()->trashed();
```

## Show a to-do list

```
$todoList = $project->todoSet()->todoLists()->show($id);
```

## Create a new to-do list

```
$todoList = $project->todoSet()->todoLists()->store([
    'name' => 'Launch',
    'description' => '<div><em>Finish it!</em></div>',
]);
```

## Update a to-do list

```
$todoList->update([
    'name' => 'Relaunch',
    'content' => '<div><strong>Try this again.</strong></div>',
]);

// Or update with ID.
$project->todoSet()->todoLists()->update($id, [...]);
```

## Delete a to-do list

```
$todoList->destroy();

// Or destroy with ID.
$project->todoSet()->todoLists()->destroy($id);
```
