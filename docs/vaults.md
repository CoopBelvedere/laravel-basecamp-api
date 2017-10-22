# Vaults

## Show a vault

```
// The vault is returned with a project dock with enough
// information for most use cases.
$vault = Basecamp::projects()->show($projectId)->vault();
```

```
// If you need to call the endpoint for more details:
$vault->show();

// Or
$vault = Basecamp::vault($projectId)->show($id);
```
