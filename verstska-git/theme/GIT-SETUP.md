# Git workflow for VERSTKADOC

Git is the version-control system for the **code**. WordPress is the system that stores the **content** in its database. GitHub is an optional remote place to store the Git repository.

Recommended local structure:

```text
VERSTKADOC/
├── theme/
│   └── verstkadoc-document-dtp/
└── plugin/
    └── verstkadoc-content/
```

The repository should contain the theme and companion plugin source. Do not put `wp-config.php`, the WordPress database dump, uploads, private keys or passwords into the repository.

Typical first-time commands from the project directory:

```bash
git init
git add .
git commit -m "VERSTKADOC v0.2.0"
```

After a later change:

```bash
git status
git diff
git add .
git commit -m "Describe the change"
```

A GitHub remote can then be added, for example:

```bash
git remote add origin https://github.com/Freely1905/verstkadoc-document-dtp.git
git branch -M main
git push -u origin main
```

The exact repository name is only an example; create the empty repository in GitHub before pushing.
