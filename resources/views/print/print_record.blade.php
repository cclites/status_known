<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
    <section>
        <table>
            <thead>
            <tr>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>DOB</th>
                <th>SSN</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $record->first_name }}</td>
                <td>{{ $record->middle_name }}</td>
                <td>{{ $record->last_name }}</td>
                <td>{{ $record->dob }}</td>
                <td>{{ $record->ssn }}</td>
            </tr>
            </tbody>
        </table>
    </section>
    <section>
        <h4>Addresses</h4>
        <table>
            <thead>
            <tr>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
            </tr>
            </thead>
            <tbody>
            @foreach($record->data['addresses'] as $r)
                <tr>
                    <td>{{ $r['address_1'] }}</td>
                    <td>{{ $r['city'] }}</td>
                    <td>{{ $r['state'] }}</td>
                    <td>{{ $r['zip'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

    <section>
        <h4>Charges</h4>
        <table>
            <thead>
            <tr>
                <th>County</th>
                <th>Date</th>
                <th>Disposition</th>
                <th>State</th>
                <th>Violation</th>
            </tr>
            </thead>
            <tbody>
            @foreach($record->data['criminal'] as $r)
                <tr>
                    <td>{{ $r['county'] }}</td>
                    <td>{{ $r['date'] }}</td>
                    <td>{{ $r['disposition'] }}</td>
                    <td>{{ $r['state'] }}</td>
                    <td>{{ $r['violation'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </section>

    <section>
        <h4>Driving Infractions</h4>
        <table>
            <thead>
            <tr>
                <th>County</th>
                <th>Date</th>
                <th>State</th>
                <th>Violation</th>
            </tr>
            </thead>
            <tbody>
            @foreach($record->data['driving'] as $r)
                <tr>
                    <td>{{ $r['county'] }}</td>
                    <td>{{ $r['date'] }}</td>
                    <td>{{ $r['state'] }}</td>
                    <td>{{ $r['violation'] }}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </section>
    </body>
</html>
