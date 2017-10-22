# Questionnaires

## Show a questionnaire

```php
// The questionnaire is returned with a project dock with enough
// information for most use cases.
$questionnaire = Basecamp::projects()->show($projectId)->questionnaire();
```

```php
// If you need to call the endpoint for more details:
$questionnaire->show();

// Or
$questionnaire = Basecamp::questionnaires($projectId)->show($id);
```
