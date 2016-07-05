# CakePHP3-Revisions


This plugin allows to create revisions on the tables of your choice and revert to a selected revision.

##Features

- Create a revision automatically after all save
- Create hasMany relation between your model and his revisions.
- Return to a revision when you want
- Link the system to the tables of your choice with a behavior.

## Installation

### Requirements

- [Composer](https://getcomposer.org/)
- [CakePHP 3.2 or above](http://cakephp.org/)

###Steps to install

It is very simple to install this plugin. Just three steps and it works.

- Run: ``composer install noczcore/cakephp3-revisions``
- Import 'config\schema\revisions.sql' in your database.
- Put ``Plugin::load('Revisions')`` in 'config\bootstrap.php'

## How to use
It's very easy !

### Behavior

To use this plugins, you must load the RevisionsBehavior in your tables.

#### For example:
```
namespace App\Model\Table;

use Cake\ORM\Table;

class PostsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Revisions.Revisions');
    }

}
```

Now, after all save, the plugin will automatically create a revision.


**For return to a revision:**

Put in your controller:
``$this->Posts->revert($post_id, $revision_id);``

## TODO
- Add unit tests.

## Licence
This plugin is released under the [MIT licence](https://github.com/NoczCore/CakePHP3-Revision/blob/master/LICENSE).
