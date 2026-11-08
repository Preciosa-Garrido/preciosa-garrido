# GitHub deployment

The repository publishes `ghcr.io/<owner>/preciosa-garrido` from GitHub
Actions. Pushes to `dev` publish `dev-<commit>` and `latest-dev`.
Tags matching `v*.*.*` publish the semantic version and `latest`.

Create the GitHub environments `dev` and `prd`. Configure each environment
with:

- secret `KUBECONFIG_CI`: kubeconfig with access only to the target namespace;
- variable `K8S_NAMESPACE`: target Kubernetes namespace;
- variable `K8S_DEPLOYMENT`: deployment name;
- variable `K8S_CONTAINER`: container name inside the deployment.

Set the repository variable `DEPLOY_ENABLED` to `true` only after both
environments are configured. Until then, the workflow publishes the GHCR image
and skips Kubernetes deployment instead of failing.

The cluster also needs an image pull secret for the private GHCR package. A
GitHub classic personal access token with `read:packages` is sufficient:

```sh
kubectl create secret docker-registry ghcr \
  --docker-server=ghcr.io \
  --docker-username=<github-user> \
  --docker-password=<token> \
  --namespace=<namespace>
```

Reference that secret from the workload's `imagePullSecrets`. The CI workflow
publishes with the repository-scoped `GITHUB_TOKEN`; no separate push token is
required.
