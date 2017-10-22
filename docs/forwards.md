# Forwards

## List forwards

```
$forwards = $project->inbox()->forwards()->index();
```

## Get a forward

```
$forward = $project->inbox()->forwards()->show($id);
```

## Delete a forward

```
$forward->destroy();

// Or destroy with ID
$project->inbox()->forwards()->destroy($id);
```
