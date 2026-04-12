<div>
    <table class="table table-bordered">
      <thead>
          <tr>
              <th>ID</th>
              <th>Name</th>
          </tr>
      </thead>
      <tbody>
          @forelse($clients as $client)
          <tr wire:key="client-{{ $client->id }}">
              <td>{{ $client->id }}</td>
              <td>{{ $client->name }}</td>
          </tr>
          @empty
          <tr>
              <td colspan="2" class="text-center">No clients found.</td>
          </tr>
          @endforelse
      </tbody>
    </table>
</div>
