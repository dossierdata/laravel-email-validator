# Contributing

## Before you get started / Agreements
* Don't install packages that are not well maintained or recently updated
* Always branch from the development branch
* Don't make a PR until you have met the requirements to make a PR
* It is advised to use to sign your commits with GPG so they can be verified

## Pull request tasks
Before making a PR check you must meet the requirements mentioned at 'Making a PR'.
Every PR needs to be reviewed by at least one developer before it gets merged.

# Making a PR
* Request a peer review by one of the developers
* Add and run unit tests
* Check if the code can build without warnings
* Update the documentation if necessary

## Decision making
If you make an important decision like installing a package update the documentation 
and explain why you made that decision.

## Styleguides

### Branching
* Mention the type of what you are working on, for example: 
  - `features/add-awesome-feature`
  - `bugfixes/fix-that-one-bug`

### Git Commit Messages
* Provide a clear and useful commit message
* Use the present tense ("Add feature" not "Added feature")
* Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
* Limit the first line to 72 characters or less
* Reference issues and pull requests liberally after the first line
* Consider starting the commit message with an applicable emoji:
    * :rainbow: `:art:` when adding new features
    * :art: `:art:` when improving the format/structure of the code
    * :racehorse: `:racehorse:` when improving performance
    * :non-potable_water: `:non-potable_water:` when plugging memory leaks
    * :memo: `:memo:` when writing docs
    * :zap: `:zap:` when applying a hotfix
    * :penguin: `:penguin:` when fixing something on Linux
    * :apple: `:apple:` when fixing something on macOS
    * :checkered_flag: `:checkered_flag:` when fixing something on Windows
    * :bug: `:bug:` when fixing a bug
    * :fire: `:fire:` when removing code or files
    * :green_heart: `:green_heart:` when fixing the CI build
    * :white_check_mark: `:white_check_mark:` when adding tests
    * :lock: `:lock:` when dealing with security
    * :arrow_up: `:arrow_up:` when upgrading dependencies
    * :arrow_down: `:arrow_down:` when downgrading dependencies
    * :large_orange_diamond: `:large_orange_diamond:` when resolving merge conflicts
    * :shirt: `:shirt:` when removing linter warnings
    * :hammer: `:hammer:` when (re)building resources or dependencies 

### Pull requests
* Use a clear and descriptive title for the PR
* Provide a step-by-step description of the changes