<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Report</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      margin: 0;
      padding: 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 6px;
      text-align: left;
      word-wrap: break-word;
    }

    .date-of-birth {
      min-width: 120px;
      /* Adjust as needed */
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <h2 style="text-align: center;">Clients Report</h2>
  <table>
    <thead>
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th class="date-of-birth">Date of Birth</th>
        <th>Telephone</th>
        <th>Next of Kin</th>
        <th>Illness</th>
        <th>Last Residence Address</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($clients as $client)
        <tr>
          <td>{{ $client->username ?? 'N/A' }}</td>
          <td>{{ $client->email ?? 'N/A' }}</td>
          <td>{{ $client->profile->first_name ?? 'N/A' }}</td>
          <td>{{ $client->profile->last_name ?? 'N/A' }}</td>
          <td>{{ $client->profile->date_of_birth ? date('d-M-Y', strtotime($client->profile->date_of_birth)) : 'N/A' }}
          </td>
          <td>{{ $client->profile->telephone ?? 'N/A' }}</td>
          <td>{{ $client->profile->next_of_kin ?? 'N/A' }}</td>
          <td>{{ $client->profile->any_illness ?? 'N/A' }}</td>
          <td>{{ $client->profile->last_residence_address ?? 'N/A' }}</td>
        </tr>
      @endforeach

    </tbody>
  </table>
</body>

</html>
