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
        <th>Question</th>
        <th>Answer</th>
    </tr>
    @forelse($unverified as $index => $unverified_fields)
        <tr>
            <td>{{ $study->study_name }}</td>
            <td>{{ $unverified_site_name[$index]->site_number }}</td>
            <td>{{ $unverified_subject_name[$index]->subject_id }}</td>
            <td>{{ $unverified_folder_name[$index]->folder_name }}</td>
            <td>{{ $unverified_file_name[$index]->file_name }}</td>
            <td>{{ $unverified_fields->question }}</td>
            <td>{{ $unverified_fields->answer }}</td>
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
        <th>Question</th>
        <th>Answer</th>
    </tr>
    @forelse($subunverified as $index => $subunverified_fields)
        <tr>
            <td>{{ $study->study_name }}</td>
            <td>{{ $subunverified_sub_main_site_name[$index]->site_number }}</td>
            <td>{{ $subunverified_sub_main_subject_name[$index]->subject_id }}</td>
            <td>{{ $subunverified_sub_main_folder_name[$index]->folder_name }}</td>
            <td>{{ $subunverified_sub_folder_name[$index]->folder_name }}</td>
            <td>{{ $subunverified_file_name[$index]->file_name }}</td>
            <td>{{ $subunverified_fields->question }}</td>
            <td>{{ $subunverified_fields->answer }}</td>
        </tr>

    @empty
        <tr>
            <td>
                Empty
            </td>
        </tr>
    @endforelse

</table>
</body>
</html>


















