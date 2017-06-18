# Contributing to Booknshelf.com

First of all, **thank you** so much for helping with Booknshelf.com!

This contributing guide is specifically for contributing to the booknshelf.com website codebase.

# Table of Contents

* [Submitting Code Changes](#submitting-code-changes)
    - [Git Workflow](#git-workflow)
    - [Issues](#issues)
    - [Style (PHP)](#style-php)
* [Roadmap](#roadmap)

## Submitting Code Changes

These instructions should get you closer to getting a commit into the
repository.

### Git Workflow

1. Fork and clone.
1. Add the upstream booknshelf.com repository as a new remote to your clone.
   `git remote add upstream https://github.com/booknshelf/booknshelf.com.git`
1. Create a new branch
   `git checkout -b name-of-you-branch`
1. Commit and push as usual on your branch.
1. When you're ready to submit a pull request, rebase your branch onto
   the upstream master so that you can resolve any conflicts:
   `git fetch upstream && git rebase upstream/master`
   You may need to push with `--force` up to your branch after resolving conflicts.
1. When you've got everything solved, push up to your branch and send the pull request as usual.

### Issues

We keep track of bugs, enhancements and support requests in the repository using GitHub [issues][].


### Style (PHP)

Booknshelf is a [Laravel](https://laravel.com) application which follows the [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) coding standard and the [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) autoloading standard.


## Roadmap

TODO


[coc]: https://github.com/booknshelf/booknshelf.com/blob/master/CODE_OF_CONDUCT.md
[local-dev-env]: https://github.com/booknshelf/booknshelf.com/blob/master/docs/setting-up-local-development.md
[issues]: https://github.com/booknshelf/booknshelf.com/issues
