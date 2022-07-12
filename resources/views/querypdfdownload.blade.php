<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h2>Verification Details</h2>

<table>
    <tr>
        <th>Study</th>
        <th>Site</th>
        <th>Subject</th>
        <th>Folder Name</th>
        <th>Filename</th>
        <th>Query</th>
    </tr>
    @forelse($main_query as $index => $main_queries)
        <tr>
            <td>{{ $study->study_name }}</td>
            <td>{{ $main_query_site[$index]->site_number }}</td>
            <td>{{ $main_query_subject[$index]->subject_id }}</td>
            <td>{{ $main_query_folder[$index]->folder_name }}</td>
            <td>{{ $main_query_file[$index]->file_name }}</td>
            <td>{{ $main_queries->body }}</td>
        </tr>
    @empty
        <td>Empty</td>
    @endforelse

</table>
<br>

<table>
    <tr>
        <th>Study</th>
        <th>Site</th>
        <th>Subject</th>
        <th>Main Folder Name</th>
        <th>Sub Folder Name</th>
        <th>Filename</th>
        <th>Query</th>
    </tr>
    @forelse($sub_query as $index => $sub_queries)
        <tr>
            <td>{{ $study->study_name }}</td>
            <td>{{ $sub_query_site_name[$index]->site_number }}</td>
            <td>{{ $sub_query_subject_name[$index]->subject_id }}</td>
            <td>{{ $sub_query_main_folder[$index]->folder_name }}</td>
            <td>{{ $sub_query_sub_folder[$index]->folder_name }}</td>
            <td>{{ $sub_query_sub_file[$index]->file_name }}</td>
            <td>{{ $sub_queries->body }}</td>
        </tr>
    @empty
        <td>Empty</td>
    @endforelse
</table>
</body>
</html>


















