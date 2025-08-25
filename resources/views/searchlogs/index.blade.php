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
                    <h1 class="text-emerald-8000 mx-auto mb-4 text-3xl font-bold">
                        {{ __('User Search Activity') }}
                    </h1>
                </x-slot>

                <div class="overflow-x-auto">
                    <table
                        class="min-w-full border-collapse divide-y divide-gray-200 rounded-lg border border-gray-400 bg-gray-200 text-left">
                        <thead class="bg-emerald-200 text-emerald-800">
                            <tr class="">
                                <th class="border border-gray-300 px-4 py-3 font-semibold">#</th>
                                <th class="border border-gray-300 px-4 py-3 font-semibold">User</th>
                                <th class="border border-gray-300 px-4 py-3 font-semibold">Route</th>
                                <th class="border border-gray-300 px-4 py-3 font-semibold">Input Fields</th>
                                <th class="border border-gray-300 px-4 py-3 font-semibold">IP</th>
                                <th class="border border-gray-300 px-4 py-3 font-semibold">Agent</th>
                                <th class="border border-gray-300 px-4 py-3 font-semibold">Time</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($logs as $log)
                                <tr
                                    class="bg-emerald-50 text-emerald-50 transition-colors duration-200 hover:bg-emerald-100 hover:text-emerald-800">
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">{{ $log->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">
                                        {{ $log->user?->name ?? 'Guest' }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">{{ $log->search_route }}
                                    </td>
                                    <td class="whitespace-pre-wrap border border-gray-300 px-4 py-2 text-gray-600">
                                        <code
                                            class="block rounded p-2 text-sm">{{ json_encode($log->input_fields, JSON_PRETTY_PRINT) }}</code>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">{{ $log->ip_address }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-500">
                                        {{ Str::limit($log->user_agent, 40) }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">
                                        {{ $log->searched_at->format('Y-M-D H:i:s') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <div class="mt-2 rounded bg-white p-4 shadow">
                        {{ $logs->appends(['per_page' => request('per_page')])->onEachSide(1)->links('pagination::tailwind') }}
                    </div>
                </div>
            </x-card>
        </div>
    </section>
</x-app-layout>
