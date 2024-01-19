<div class="card mb-4">
    <div class="card-body">
        <a href="{{ url()->previous() }}" class="btn btn-primary mb-3">< Go Back</a>
        <canvas id="historicalChart" width="400" height="200"></canvas>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table">
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
            @foreach ($data as $row)
                <tr>
                    <td>{{ date("Y-m-d H:i:s", $row['date']) }}</td>
                    <td>{{ $row['open'] }}</td>
                    <td>{{ $row['high'] }}</td>
                    <td>{{ $row['low'] }}</td>
                    <td>{{ $row['close'] }}</td>
                    <td>{{ $row['volume'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>