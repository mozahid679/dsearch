<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Search Logs') }}
        </h2>
    </x-slot>

    <section>
        <div class="mx-auto mt-2 max-w-7xl">
            <x-card class="mx-auto max-w-6xl bg-white bg-opacity-90 shadow-lg">
                <x-slot name="title">
                    <h1 class="mb-4 text-3xl font-bold text-blue-800">
                        {{ __('User Search Activity') }}
                    </h1>
                </x-slot>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 font-medium text-gray-600">User</th>
                                <th class="px-4 py-3 font-medium text-gray-600">Route</th>
                                <th class="px-4 py-3 font-medium text-gray-600">Input Fields</th>
                                <th class="px-4 py-3 font-medium text-gray-600">IP</th>
                                <th class="px-4 py-3 font-medium text-gray-600">Agent</th>
                                <th class="px-4 py-3 font-medium text-gray-600">Time</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($logs as $log)
                                <tr>
                                    <td class="px-4 py-2 text-gray-700">{{ $log->user?->name ?? 'Guest' }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $log->search_route }}</td>
                                    <td class="whitespace-pre-wrap px-4 py-2 text-xs text-gray-600">
                                        <code>{{ json_encode($log->input_fields, JSON_PRETTY_PRINT) }}</code>
                                    </td>
                                    <td class="px-4 py-2 text-gray-700">{{ $log->ip_address }}</td>
                                    <td class="px-4 py-2 text-xs text-gray-500">{{ Str::limit($log->user_agent, 40) }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-700">{{ $log->searched_at->format('Y-m-d H:i:s') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $logs->links() }}
                </div>
            </x-card>
        </div>
    </section>
</x-app-layout>
