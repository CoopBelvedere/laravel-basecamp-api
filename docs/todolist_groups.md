# To-do List Groups

## List to-do list groups

```php
// First get the to-do list
$todoList = $project->todoSet()->todoLists()->show($id);

// List all to-do list groups
$todoListGroups = $todoList->groups()->index();

// List archived to-do list groups
$todoListGroups = $todoList->groups()->archived();

// List trashed to-do list groups
$todoListGroups = $todoList->groups()->trashed();
```

## Show a to-do list group

```php
$todoListGroup = $todoList->groups()->show($id);
```

## Create a new to-do list group

```php
$todoList = $todoList->groups()->store([
    'name' => 'The Spencer Davis Group',
]);
```

## Reposition a to-do list group

```php
$todoListGroup->reposition(2);

// Or reposition with ID.
$todoList->groups()->reposition($id, 2);
```
