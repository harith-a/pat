<?php

namespace AjaxLiveSearch\core;

if (count(get_included_files()) === 1) {
    exit('Direct access not permitted.');
}

/**
 * Class Config
 */
class Config
{
    /**
     * @var array
     */
    private static $configs = array(
        // ***** Database ***** //
        // change <input> id to target data source e.g:ls_query -> ls_query_2
        'dataSources'           => array(
            'ls_query' => array(
                'host'               => 'localhost',
                'database'           => 'blabla',
                'username'           => 'blabla',
                'pass'               => 'blabla',
                'table'              => 'blabla',
                // specify the name of search columns
                'searchColumns'      => array('NAMA','NO_KP'),
                // specify order by column. This is optional
                'orderBy'            => '',
                // specify order direction e.g. ASC or DESC. This is optional
                'orderDirection'     => '',
                // filter the result by entering table column names
                // to get all the columns, remove filterResult or make it an empty array
                'filterResult'       => array(),
                // 'filterResult'       => array('Nama','IC'),
                // specify search query comparison operator. possible values for comparison operators are: 'LIKE' and '='. this is required.
                'comparisonOperator' => 'LIKE',
                // searchPattern is used to specify how the query is searched. possible values are: 'q', '*q', 'q*', '*q*'. this is required.
                'searchPattern'      => '*q*',
                // specify search query case sensitivity
                'caseSensitive'      => false,
                // to limit the maximum number of result uncomment this:
                'maxResult' => 10,
                // to display column header, change 'active' value to true
                'displayHeader' => array(
                    'active' => false,
                    'mapper' => array(
//                        'your_first_column' => 'Your Desired Title',
//                        'your_second_column' => 'Your Desired Second Title'
                    )
                ),
                // add custom class to <td> and <th>
                // To hide a column use class 'ls_hide'
                'columnClass' => array(
                    'NO' => 'ls_hide',
                    'Registered' => 'ls_hide',
                    'JANTINA' => 'ls_hide',
                    'KAWASAN' => 'ls_hide',
                    'NEGERI' => 'ls_hide',
                    'NO_AHLI' => 'ls_hide',
                //    'your_column_name_1' => 'Your Desired Class',
                //    'column_name_2' => 'ls_hide'
                ),
                'type'               => 'mysql',
            ),
            'ls_query_2' => array(
                'host'               => 'localhost',
                'database'           => 'pat18',
                'username'           => 'dbikram',
                'pass'               => 'dbikramikram',
                'table'              => 'pti_petugas',
                // specify the name of search columns
                'searchColumns'      => array('NAMA','NO_KP'),
                // specify order by column. This is optional
                'orderBy'            => '',
                // specify order direction e.g. ASC or DESC. This is optional
                'orderDirection'     => '',
                // filter the result by entering table column names
                // to get all the columns, remove filterResult or make it an empty array
                'filterResult'       => array(),
                // 'filterResult'       => array('Nama','IC'),
                // specify search query comparison operator. possible values for comparison operators are: 'LIKE' and '='. this is required.
                'comparisonOperator' => 'LIKE',
                // searchPattern is used to specify how the query is searched. possible values are: 'q', '*q', 'q*', '*q*'. this is required.
                'searchPattern'      => '*q*',
                // specify search query case sensitivity
                'caseSensitive'      => false,
                // to limit the maximum number of result uncomment this:
                'maxResult' => 10,
                // to display column header, change 'active' value to true
                'displayHeader' => array(
                    'active' => false,
                    'mapper' => array(
//                        'your_first_column' => 'Your Desired Title',
//                        'your_second_column' => 'Your Desired Second Title'
                    )
                ),
                // add custom class to <td> and <th>
                // To hide a column use class 'ls_hide'
                'columnClass' => array(
                    'NO' => 'ls_hide',
                    'Registered' => 'ls_hide',
                    'JANTINA' => 'ls_hide',
                    'KAWASAN' => 'ls_hide',
                    'NEGERI' => 'ls_hide',
                    'NO_AHLI' => 'ls_hide',
                //    'your_column_name_1' => 'Your Desired Class',
                //    'column_name_2' => 'ls_hide'
                ),
                'type'               => 'mysql',
            ),
            'semua_ahli' => array(
                'host'               => 'localhost',
                'database'           => 'blabla',
                'username'           => 'blabla',
                'pass'               => 'blabla',
                'table'              => 'blabla',
                // specify the name of search columns
                'searchColumns'      => array('NAMA','NO_KP'),
                // specify order by column. This is optional
                'orderBy'            => '',
                // specify order direction e.g. ASC or DESC. This is optional
                'orderDirection'     => '',
                // filter the result by entering table column names
                // to get all the columns, remove filterResult or make it an empty array
                'filterResult'       => array(),
                // 'filterResult'       => array('Nama','IC'),
                // specify search query comparison operator. possible values for comparison operators are: 'LIKE' and '='. this is required.
                'comparisonOperator' => 'LIKE',
                // searchPattern is used to specify how the query is searched. possible values are: 'q', '*q', 'q*', '*q*'. this is required.
                'searchPattern'      => '*q*',
                // specify search query case sensitivity
                'caseSensitive'      => false,
                // to limit the maximum number of result uncomment this:
                'maxResult' => 10,
                // to display column header, change 'active' value to true
                'displayHeader' => array(
                    'active' => false,
                    'mapper' => array(
//                        'your_first_column' => 'Your Desired Title',
//                        'your_second_column' => 'Your Desired Second Title'
                    )
                ),
                // add custom class to <td> and <th>
                // To hide a column use class 'ls_hide'
                'columnClass' => array(
                    'NO' => 'ls_hide',
                    'Registered' => 'ls_hide',
                    'JANTINA' => 'ls_hide',
                    'KAWASAN' => 'ls_hide',
                    'NEGERI' => 'ls_hide',
                    'NO_AHLI' => 'ls_hide',
                //    'your_column_name_1' => 'Your Desired Class',
                //    'column_name_2' => 'ls_hide'
                ),
                'type'               => 'mysql',
            ),
            'mainMongo' => array(
                'server'       => 'your_server',
                'database'     => 'local',
                'collection'   => 'your_collection',
                'filterResult' => array(),
                'searchField'  => 'your_collection_search_field',
                'type'         => 'mongo',
            )
        ),
        // ***** Form ***** //
        'antiBot'               => "ajaxlivesearch_guard",
        // Assigning more than 3 seconds is not recommended
        'searchStartTimeOffset' => 1,
        // ***** Search Input ***** /
        'maxInputLength'        => 20,
    );

    /**
     *
     * @param  $key
     * @throws \Exception
     * @return mixed
     */
    public static function getConfig($key)
    {
        if (!array_key_exists($key, static::$configs)) {
            throw new \Exception("Key: {$key} does not exist in the configs");
        }

        return static::$configs[$key];
    }
}
