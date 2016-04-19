<?php

namespace admin\ngrest\plugins;

/**
 * Single File-Upload
 * 
 * @author nadar
 */
class File extends \admin\ngrest\base\Plugin
{
    /**
     * 
     * {@inheritDoc}
     * @see \admin\ngrest\base\Plugin::renderList()
     */
    public function renderList($id, $ngModel)
    {
        return $this->createTag('storage-file-display', null, ['file-id' => "{{{$ngModel}}}"]);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \admin\ngrest\base\Plugin::renderCreate()
     */
    public function renderCreate($id, $ngModel)
    {
        return $this->createFormTag('zaa-file-upload', $id, $ngModel);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \admin\ngrest\base\Plugin::renderUpdate()
     */
    public function renderUpdate($id, $ngModel)
    {
        return $this->renderCreate($id, $ngModel);
    }
}
