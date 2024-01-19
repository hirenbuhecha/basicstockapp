<p>Company Name: {{ $companyName }}</p>
<p>Start Date: {{ $startDate }}</p>
<p>End Date: {{ $endDate }}</p>

<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Open</th>
        <th>High</th>
        <th>Low</th>
        <th>Close</th>
        <th>Volume</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($historicalData as $row)
        <tr>
            <td>{{ $row['date'] }}</td>
            <td>{{ $row['open'] }}</td>
            <td>{{ $row['high'] }}</td>
            <td>{{ $row['low'] }}</td>
            <td>{{ $row['close'] }}</td>
            <td>{{ $row['volume'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
