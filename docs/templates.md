# Templates

## List templates

```
// List all templates
$templates = Basecamp::templates()->index();

// List archived templates
$templates = Basecamp::templates()->archived();

// List trashed templates
$templates = Basecamp::templates()->trashed();
```

## Show a template

```
$template = Basecamp::templates()->show($id);
```

## Create a new template

```
$template = Basecamp::templates()->store([
    'name' => 'New Starter Checklist',
    'description' => 'Things every new starter should do in their first week',
]);
```

## Update a template

```
$template->update([
    'name' => 'Old Master Checklist',
    'description' => 'Things every old master should do in their last week',
]);

// Or update with ID.
Basecamp::templates()->update($id, [...]);
```

## Delete a template

```
$template->destroy();

// Or destroy with ID.
Basecamp::templates()->destroy($id);
```

## Create a project construction

```
$projectConstruction = $template->projectConstructions()->store([
    'name': 'Marketing ',
    'description': '2016-2017 Strategy',
]);
```

## Get a project construction

```
$projectConstruction = $template->projectConstructions()->show($projectConstruction->id);
```

## Example: polling a newly created project construction

```
// Polling 1 time per second for a maximum of 10 seconds.
$projectConstruction = retry(10, function () use ($template) use ($id) {
    $projectConstruction = $template->projectConstructions()->show($id);
    if ($projectConstruction->status != 'completed') {
        throw new \Exception('Project not completed');
    }
    return $projectConstruction;
}, 1000);

// Create the project object.
$project = new \Belvedere\Basecamp\Models\Project($projectConstruction->project);
```
