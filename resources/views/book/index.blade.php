<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ URL::asset('/') }}themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('/') }}scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />

        <script src="{{ URL::asset('/') }}scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
        <script src="{{ URL::asset('/') }}scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <script src="{{ URL::asset('/') }}scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
        <style>
        .mainContainer,.filter{
        margin:auto;
        width: 90%; 
        }
        .selectlang{
            text-align: right;
        }
       </style>
    </head>
    <body>
         <div class="filter">
         <select name="locale" id="locale" class="selectlang">
             <option value="en" <?php if($locale == 'en'){ ?> selected="selected"<?php  } ?>>English</option>
             <option value="es" <?php if($locale == 'es'){ ?> selected="selected"<?php  } ?>>Spanish</option>
         </select>
        </div>
         <br>
       <div id="PeopleTableContainer" class="mainContainer" lang="{{ str_replace('_', '-', app()->getLocale()) }}" ></div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $('#locale').change(function (e) {
            e.preventDefault();
              $('#PeopleTableContainer').jtable('load', {
                locale: $('#locale').val(),
            });
        });
        $(document).ready(function () {

            //Prepare jTable
            $('#PeopleTableContainer').jtable({
                title: "Books",
                paging: true,
                
                actions: {
                    listAction: "/books",
                },
                fields: {
                    id: {
                        key: true,
                        create: false,
                        edit: false,
                        list: false
                    },
                    book_title: {
                        title: "{{ __('book.book_title') }}",
                        width: '25%',
                    },
                    cats: {
                        title: "{{ __('book.book_category') }}",
                        width: '25%',
                    },
                    book_author: {
                        title: "{{ __('book.book_author') }}",
                        width: '25%',
                    },
                    issued_on : {
                        title: "{{ __('book.issue_date') }}",
                        width: '25%',
                        type: 'datetime',
                    }
                }
            });
            //Load person list from server
            $('#PeopleTableContainer').jtable('load');
        });
    </script>
    </body>
</html>
