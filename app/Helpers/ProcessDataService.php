<?php

namespace App\Helpers;

class ProcessDataService
{
    protected function getFormattedData($requestData, $fields)
    {
        $languages = [config('custom.language_ru'), config('custom.language_en')];

        foreach ($languages as $lang) {
            $tempData = [];
            foreach ($fields as $field) {
                $tempData[$field] = $requestData[$field . '_' . $lang] ?? '';
            }
        }

        return $requestData;
    }

    protected function findOrFailWithTranslation( $fullClass, $id)
    {
        $project = $fullClass::findOrFail($id);
        $languages = [config('custom.language_ru'), config('custom.language_en')];

        foreach ($languages as $lang) {
            $project_temp = $project->translate($lang);
            $project->{$lang . '_title'} = $project_temp->title;
            $project->{$lang . '_additional'} = $project_temp->additional;
            $project->{$lang . '_additional_multi'} = $project_temp->additional_multi;
        }

        return $project;
    }
}
