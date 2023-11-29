<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Source Report</title>
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
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <h2 style="text-align: center;">Recommended Sources Report</h2>
  <table>
    <thead>
      <tr>
        <th>Source Type</th>
        <th>Source Address</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($recommendedSources as $source)
        <tr>
          <td>{{ $source->source_type }}</td>
          <td>{{ $source->source_address }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
