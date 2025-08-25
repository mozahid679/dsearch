
<table>
    <thead>
        <tr>
            <th>Registration No</th>
            <th>Company Name</th>
            <th>Client ID</th>
            <th>Person Name</th>
            <th>Father's Name</th>
            <th>National ID</th>
            <th>Birth Date</th>
            <th>Present Address</th>
            <th>Permanent Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $result)
            <tr>
                <td>{{ $result->registration_no }}</td>
                <td>{{ $result->company_name }}</td>
                <td>{{ $result->client_id }}</td>
                <td>{{ $result->person_name }}</td>
                <td>{{ $result->fathers_name }}</td>
                <td>{{ $result->national_id }}</td>
                <td>{{ $result->birth_date }}</td>
                <td>{{ $result->present_address }}</td>
                <td>{{ $result->permanent_address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
