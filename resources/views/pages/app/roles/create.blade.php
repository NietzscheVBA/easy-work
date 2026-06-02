<x-layouts.app title="Novo Papel — Controle de Usuários">

    {{-- ── Cabeçalho ──────────────────────────────────────────────── --}}
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.role.index') }}"
           class="p-2 text-slate-400 hover:text-slate-700 hover:bg-white rounded-xl
                  border border-transparent hover:border-slate-200 transition-all duration-150">
            <x-ui.icon name="arrow-left" class="w-4 h-4" />
        </a>
        <x-ui.page-heading
            title="Novo Papel"
            description="Crie um papel e defina quais permissões ele agrupa"
        />
    </div>

    {{-- ── Formulário ─────────────────────────────────────────────── --}}
    <form method="POST"
          action="{{ route('admin.role.store') }}"
          x-data="{
              roleName:    '{{ old('name') }}',
              permissions: {{ json_encode(old('permissions', [])) }},
              search:      '',

              togglePermission(id) {
                  const idx = this.permissions.indexOf(id)
                  idx === -1 ? this.permissions.push(id) : this.permissions.splice(idx, 1)
              },

              selectAll(ids) {
                  ids.forEach(id => { if (!this.permissions.includes(id)) this.permissions.push(id) })
              },

              deselectAll(ids) {
                  this.permissions = this.permissions.filter(id => !ids.includes(id))
              },

              allSelected(ids) {
                  return ids.length > 0 && ids.every(id => this.permissions.includes(id))
              },

              someSelected(ids) {
                  return ids.some(id => this.permissions.includes(id)) && !this.allSelected(ids)
              },
          }"
          novalidate>
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ── Coluna principal (2/3) ─────────────────────────── --}}
            <div class="xl:col-span-2 space-y-6">

                {{-- Card: Identificação --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">

                    <x-ui.form-section
                        title="Identificação"
                        description="Nome e descrição do papel"
                    />

                    <div class="space-y-5">
                        <x-ui.input
                            label="Nome do papel"
                            name="name"
                            placeholder="Ex: Administrador, Editor, Suporte"
                            icon="tag"
                            :required="true"
                            hint="Escolha um nome claro que represente o conjunto de permissões"
                            x-model="roleName"
                        />

                        <x-ui.textarea
                            label="Descrição"
                            name="description"
                            placeholder="Descreva o que um usuário com este papel pode fazer no sistema..."
                            :rows="3"
                            :required="true"
                            hint="Explique as responsabilidades e limites deste papel"
                        />
                    </div>
                </div>

                {{-- Card: Permissões --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">

                    <div class="flex items-start justify-between gap-4 pb-4 mb-5 border-b border-slate-100">
                        <div>
                            <h3 class="text-sm font-bold text-slate-700">Permissões</h3>
                            <p class="text-xs text-slate-400 mt-0.5">
                                Selecione as permissões que este papel vai agrupar
                            </p>
                        </div>
                        {{-- Contador --}}
                        <span class="flex-shrink-0 inline-flex items-center gap-1.5 px-2.5 py-1
                                     rounded-full text-xs font-semibold
                                     bg-violet-50 text-violet-600 border border-violet-100">
                            <x-ui.icon name="lock" class="w-3 h-3" />
                            <span x-text="permissions.length"></span>
                            selecionada(s)
                        </span>
                    </div>

                    @if($permissions->isEmpty())
                        {{-- Empty state --}}
                        <div class="flex flex-col items-center gap-3 py-12 text-center">
                            <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">
                                <x-ui.icon name="lock" class="w-6 h-6 text-slate-400" />
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-600">Nenhuma permissão cadastrada</p>
                                <p class="text-xs text-slate-400 mt-1">
                                    <a href="{{ route('admin.permission.create') }}"
                                       class="text-blue-500 hover:underline">Crie permissões</a>
                                    antes de montar um papel.
                                </p>
                            </div>
                        </div>

                    @else

                        {{-- Barra de busca + Selecionar todos --}}
                        <div class="flex flex-col sm:flex-row gap-3 mb-5">
                            <div class="relative flex-1">
                                <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                    <x-ui.icon name="search" class="w-4 h-4 text-slate-400" />
                                </div>
                                <input
                                    type="text"
                                    x-model="search"
                                    placeholder="Filtrar permissões..."
                                    class="w-full pl-9 pr-4 py-2 text-sm bg-slate-50 border border-slate-200
                                           rounded-xl focus:outline-none focus:ring-2 focus:ring-violet-500/20
                                           focus:border-violet-400 focus:bg-white transition-all"
                                />
                            </div>

                            {{-- Select all / Deselect all --}}
                            @php $allIds = $permissions->pluck('id')->toJson(); @endphp
                            <div class="flex gap-2 flex-shrink-0">
                                <button type="button"
                                        @click="selectAll({{ $allIds }})"
                                        :disabled="allSelected({{ $allIds }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold
                                               rounded-xl border transition-all duration-150
                                               bg-violet-50 text-violet-600 border-violet-200
                                               hover:bg-violet-100 disabled:opacity-40 disabled:cursor-not-allowed">
                                    <x-ui.icon name="select-all" class="w-3.5 h-3.5" />
                                    Todas
                                </button>
                                <button type="button"
                                        @click="deselectAll({{ $allIds }})"
                                        :disabled="permissions.length === 0"
                                        class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold
                                               rounded-xl border transition-all duration-150
                                               bg-slate-50 text-slate-600 border-slate-200
                                               hover:bg-slate-100 disabled:opacity-40 disabled:cursor-not-allowed">
                                    <x-ui.icon name="minus-square" class="w-3.5 h-3.5" />
                                    Nenhuma
                                </button>
                            </div>
                        </div>

                        {{-- Grupos de permissões --}}
                        @php
                            // Agrupa permissões pelo prefixo do slug (antes do primeiro '_')
                            $grouped = $permissions->groupBy(function ($p) {
                                $parts = explode('_', $p->slug);
                                return ucfirst($parts[0]);
                            });
                        @endphp

                        <div class="space-y-6">
                            @foreach($grouped as $group => $groupPermissions)
                                @php $groupIds = $groupPermissions->pluck('id')->toJson(); @endphp

                                <div x-show="{{ $groupPermissions->map(fn($p) => "'{$p->name}'.toLowerCase().includes(search.toLowerCase()) || '{$p->slug}'.toLowerCase().includes(search.toLowerCase())")->join(' || ') }}">

                                    {{-- Group header --}}
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">
                                                {{ $group }}
                                            </span>
                                            <span class="text-xs text-slate-400">
                                                ({{ $groupPermissions->count() }})
                                            </span>
                                        </div>

                                        {{-- Group toggle --}}
                                        <button type="button"
                                                @click="allSelected({{ $groupIds }})
                                                    ? deselectAll({{ $groupIds }})
                                                    : selectAll({{ $groupIds }})"
                                                class="text-xs font-semibold transition-colors"
                                                :class="allSelected({{ $groupIds }})
                                                    ? 'text-violet-600 hover:text-violet-800'
                                                    : 'text-slate-400 hover:text-violet-600'">
                                            <span x-text="allSelected({{ $groupIds }}) ? 'Desmarcar grupo' : 'Marcar grupo'"></span>
                                        </button>
                                    </div>

                                    {{-- Permission checkboxes --}}
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($groupPermissions as $permission)
                                            <div x-show="
                                                '{{ strtolower($permission->name) }}'.includes(search.toLowerCase()) ||
                                                '{{ strtolower($permission->slug) }}'.includes(search.toLowerCase())
                                            ">
                                                <x-ui.permission-checkbox
                                                    :permission="$permission"
                                                    :checked="in_array($permission->id, old('permissions', []))"
                                                />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Mensagem quando busca não encontra nada --}}
                        <p class="text-center text-sm text-slate-400 py-8 hidden"
                           x-show="search.length > 0 && !{{ $permissions->map(fn($p) => "'{$p->name}'.toLowerCase().includes(search.toLowerCase()) || '{$p->slug}'.toLowerCase().includes(search.toLowerCase())")->join(' || ') }}">
                            Nenhuma permissão encontrada para "<span x-text="search"></span>".
                        </p>

                        @error('permissions')
                            <p class="text-xs text-red-500 flex items-center gap-1 mt-4">
                                <x-ui.icon name="alert-circle" class="w-3 h-3 flex-shrink-0" />
                                {{ $message }}
                            </p>
                        @enderror

                    @endif
                </div>

            </div>

            {{-- ── Coluna lateral (1/3) ───────────────────────────── --}}
            <div class="space-y-5">

                {{-- Prévia do papel --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <x-ui.form-section title="Prévia" />

                    <div class="flex flex-col items-center gap-4 py-2">
                        <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-500
                                    flex items-center justify-center shadow-sm">
                            <x-ui.icon name="shield" class="w-7 h-7" />
                        </div>

                        <div class="text-center space-y-1">
                            <p class="text-sm font-bold text-slate-800"
                               x-text="roleName || 'Nome do papel'"></p>
                            <p class="text-xs text-slate-400">
                                <span x-text="permissions.length"></span>
                                permissão(ões) atribuída(s)
                            </p>
                        </div>

                        {{-- Badges das permissões selecionadas --}}
                        <div class="w-full flex flex-wrap gap-1.5 justify-center"
                             x-show="permissions.length > 0">
                            @foreach($permissions as $permission)
                                <span x-show="permissions.includes({{ $permission->id }})"
                                      class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full
                                             text-xs font-mono text-violet-600
                                             bg-violet-50 border border-violet-100">
                                    {{ $permission->slug }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Dica --}}
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
                    <div class="flex gap-3">
                        <x-ui.icon name="alert-circle" class="w-4 h-4 text-blue-500 flex-shrink-0 mt-0.5" />
                        <div>
                            <p class="text-xs font-bold text-blue-700 mb-1">Sobre papéis</p>
                            <ul class="text-xs text-blue-600 space-y-1.5 leading-relaxed">
                                <li>• Um usuário pode ter mais de um papel</li>
                                <li>• Papéis agrupam permissões para facilitar a gestão</li>
                                <li>• Você pode editar as permissões de um papel a qualquer momento</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Ações --}}
                <x-ui.form-actions
                    submitLabel="Criar Papel"
                    icon="check-circle"
                    :cancelHref="route('admin.role.index')"
                    cancelLabel="Cancelar"
                />

            </div>
        </div>

    </form>

</x-layouts.app>
