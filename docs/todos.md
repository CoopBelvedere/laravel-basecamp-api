# To-dos

## List to-dos

```
// List all to-dos
$todos = $todoList->todos()->index();

// List archived to-dos
$todos = $todoList->todos()->archived();

// List trashed to-dos
$todos = $todoList->todos()->trashed();
```

## Show a to-do

```
$todo = $todoList->todos()->show($id);
```

## Create a new to-do

```
$todo = $todoList()->todos()->store([
    'content' => 'Program it',
    'description' => '<div><em>Start it!</em></div>',
    'assignee_ids' => [$assignee1Id, $assignee2Id],
    'notify' => false,
    'due_on' => '2017-12-31',
    'starts_on' => '2017-10-22',
]);
```

## Update a to-do

```
$todo->update([
    'content' => 'Program it again',
    'description' => '<div><em>Finish it!</em></div>',
    'assignee_ids' => [$assignee1Id],
    'notify' => true,
    'due_on' => '2017-12-31',
    'starts_on' => '2017-10-22',
]);

// Or update with ID.
$todoList->todos()->update($id, [...]);
```

## Complete a to-do

```
$todo->complete();

// Or complete with ID.
$todoList->todos()->complete($id);
```

## Uncomplete a to-do

```
$todo->uncomplete();

// Or uncomplete with ID.
$todoList->todos()->uncomplete($id);
```

## Reposition a to-do

```
$todo->reposition(2);

// Or reposition with ID.
$todoList->todos()->reposition($id, 2);
```

