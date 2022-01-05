<?php

$routes = array (
  'key' => '',
  'attributes' => 
  array (
  ),
  'rule' => 
  array (
    0 => '',
    1 => 
    array (
    ),
    2 => 
    array (
    ),
  ),
  'default' => 
  array (
    0 => '',
    1 => 
    array (
    ),
  ),
  'routes' => 
  array (
    'repositories' => 
    array (
      'key' => 'workspace',
      'attributes' => 
      array (
      ),
      'rule' => 
      array (
        0 => 'any',
        1 => 
        array (
        ),
        2 => 
        array (
        ),
      ),
      'default' => 
      array (
        0 => '',
        1 => 
        array (
        ),
      ),
      'routes' => 
      array (
        '' => 
        array (
          'key' => 'repo_slug',
          'attributes' => 
          array (
          ),
          'rule' => 
          array (
            0 => 'any',
            1 => 
            array (
            ),
            2 => 
            array (
            ),
          ),
          'default' => 
          array (
            0 => '',
            1 => 
            array (
            ),
          ),
          'routes' => 
          array (
            '' => 
            array (
              'key' => '',
              'attributes' => 
              array (
              ),
              'rule' => 
              array (
                0 => '',
                1 => 
                array (
                ),
                2 => 
                array (
                ),
              ),
              'default' => 
              array (
                0 => '',
                1 => 
                array (
                ),
              ),
              'routes' => 
              array (
                'issues' => 
                array (
                  'key' => '',
                  'attributes' => 
                  array (
                  ),
                  'rule' => 
                  array (
                    0 => '',
                    1 => 
                    array (
                    ),
                    2 => 
                    array (
                    ),
                  ),
                  'default' => 
                  array (
                    0 => '',
                    1 => 
                    array (
                    ),
                  ),
                  'routes' => 
                  array (
                    'export' => 
                    array (
                      'key' => 'repo_name',
                      'attributes' => 
                      array (
                      ),
                      'rule' => 
                      array (
                        0 => 'any',
                        1 => 
                        array (
                        ),
                        2 => 
                        array (
                        ),
                      ),
                      'default' => 
                      array (
                        0 => '',
                        1 => 
                        array (
                        ),
                      ),
                      'routes' => 
                      array (
                        '' => 
                        array (
                          'key' => '',
                          'attributes' => 
                          array (
                          ),
                          'rule' => 
                          array (
                            0 => '',
                            1 => 
                            array (
                            ),
                            2 => 
                            array (
                            ),
                          ),
                          'default' => 
                          array (
                            0 => '',
                            1 => 
                            array (
                            ),
                          ),
                          'routes' => 
                          array (
                            '-issues-' => 
                            array (
                              'key' => 'task_id',
                              'attributes' => 
                              array (
                              ),
                              'rule' => 
                              array (
                                0 => 'any',
                                1 => 
                                array (
                                ),
                                2 => 
                                array (
                                ),
                              ),
                              'default' => 
                              array (
                                0 => '',
                                1 => 
                                array (
                                ),
                              ),
                              'routes' => 
                              array (
                                '' => 
                                array (
                                  'key' => '',
                                  'attributes' => 
                                  array (
                                  ),
                                  'rule' => 
                                  array (
                                    0 => '',
                                    1 => 
                                    array (
                                    ),
                                    2 => 
                                    array (
                                    ),
                                  ),
                                  'default' => 
                                  array (
                                    0 => '',
                                    1 => 
                                    array (
                                    ),
                                  ),
                                  'routes' => 
                                  array (
                                    '.zip' => 
                                    array (
                                      'key' => '',
                                      'attributes' => 
                                      array (
                                        'GET' => 'repositories_workspace_repo_slug_issues_export_repo_name_issues_task_id_zip',
                                      ),
                                      'rule' => 
                                      array (
                                        0 => '',
                                        1 => 
                                        array (
                                        ),
                                        2 => 
                                        array (
                                        ),
                                      ),
                                      'default' => 
                                      array (
                                        0 => '',
                                        1 => 
                                        array (
                                        ),
                                      ),
                                      'routes' => 
                                      array (
                                      ),
                                    ),
                                  ),
                                ),
                              ),
                            ),
                          ),
                        ),
                      ),
                    ),
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'addon' => 
    array (
      'key' => '',
      'attributes' => 
      array (
        'GET' => 
        array (
          '_route' => 'addon',
        ),
      ),
      'rule' => 
      array (
        0 => '',
        1 => 
        array (
        ),
        2 => 
        array (
        ),
      ),
      'default' => 
      array (
        0 => '',
        1 => 
        array (
        ),
      ),
      'routes' => 
      array (
        'linkers' => 
        array (
          'key' => 'linker_key',
          'attributes' => 
          array (
            'GET' => 
            array (
              '_route' => 'addon_linkers',
            ),
          ),
          'rule' => 
          array (
            0 => 'any',
            1 => 
            array (
            ),
            2 => 
            array (
              'GET' => 
              array (
                '_route' => 'addon_linkers_linker_key',
              ),
            ),
          ),
          'default' => 
          array (
            0 => '',
            1 => 
            array (
            ),
          ),
          'routes' => 
          array (
            '' => 
            array (
              'key' => '',
              'attributes' => 
              array (
              ),
              'rule' => 
              array (
                0 => '',
                1 => 
                array (
                ),
                2 => 
                array (
                ),
              ),
              'default' => 
              array (
                0 => '',
                1 => 
                array (
                ),
              ),
              'routes' => 
              array (
                'values' => 
                array (
                  'key' => 'value_id',
                  'attributes' => 
                  array (
                    'GET' => 
                    array (
                      '_route' => 'addon_linkers_linker_key_values',
                    ),
                  ),
                  'rule' => 
                  array (
                    0 => 'any',
                    1 => 
                    array (
                    ),
                    2 => 
                    array (
                      'GET' => 
                      array (
                        '_route' => 'addon_linkers_linker_key_values_value_id',
                      ),
                    ),
                  ),
                  'default' => 
                  array (
                    0 => '',
                    1 => 
                    array (
                    ),
                  ),
                  'routes' => 
                  array (
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'hook_events' => 
    array (
      'key' => 'subject_type',
      'attributes' => 
      array (
        'GET' => 
        array (
          '_route' => 'hook_events',
        ),
      ),
      'rule' => 
      array (
        0 => 'any',
        1 => 
        array (
        ),
        2 => 
        array (
          'GET' => 
          array (
            '_route' => 'hook_events_subject_type',
          ),
        ),
      ),
      'default' => 
      array (
        0 => '',
        1 => 
        array (
        ),
      ),
      'routes' => 
      array (
      ),
    ),
    'pullrequests' => 
    array (
      'key' => 'selected_user',
      'attributes' => 
      array (
      ),
      'rule' => 
      array (
        0 => 'any',
        1 => 
        array (
        ),
        2 => 
        array (
          'GET' => 
          array (
            '_route' => 'pullrequests_selected_user',
          ),
        ),
      ),
      'default' => 
      array (
        0 => '',
        1 => 
        array (
        ),
      ),
      'routes' => 
      array (
      ),
    ),
  ),
);
return \Ertuo\UnfoldedRoute::fromArray($routes);
