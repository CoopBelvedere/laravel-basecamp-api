# Message Boards

## Show a message board

```
// The message board is returned with a project dock with enough
// information for most use cases.
$messageBoard = Basecamp::projects()->show($projectId)->messageBoard();
```

```
// If you need to call the endpoint for more details:
$messageBoard = $messageBoard->show();

// Or
$messageBoard = Basecamp::messageBoards($projectId)->show($id);
```
