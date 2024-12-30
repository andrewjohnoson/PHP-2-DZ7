<?php

return [
    'getVars' => function ($model)
    {
        return get_object_vars($model);
    },
    'getAuthor' => function ($model)
    {
        if ($model instanceof \App\Models\Article) {
            return $model->author;
        } else {
            return 'Не новостная статья';
        }
    },
    'getClass' => function ($model)
    {
        return get_class($model);
    }
];