<x-layouts.app title="Novo Cadastro — Controle de Usuários">

    {{-- ── Cabeçalho da página ──────────────────────────────────── --}}
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.config.index') }}"
           class="p-2 text-slate-400 hover:text-slate-700 hover:bg-white rounded-xl
                  border border-transparent hover:border-slate-200 transition-all duration-150">
            <x-ui.icon name="arrow-left" class="w-4 h-4" />
        </a>
        <x-ui.page-heading
            title="Novo Cadastro"
            description="Preencha os dados do usuário e da empresa"
        />
    </div>

    {{-- ── Formulário principal ─────────────────────────────────── --}}
    <form method="POST"
          action="{{ route('admin.tenants.store') }}"
          enctype="multipart/form-data"
          x-data="{
              userName:    '{{ old('name') }}',
              companyName: '{{ old('company_name') }}',
              cnpj:        '{{ old('cnpj') }}',
              logoPreview: null,
              password:    '',

              formatCnpj(v) {
                  const d = v.replace(/\D/g,'').slice(0,14)
                  return d.replace(/^(\d{2})(\d)/,'$1.$2')
                           .replace(/^(\d{2})\.(\d{3})(\d)/,'$1.$2.$3')
                           .replace(/\.(\d{3})(\d)/,'.$1/$2')
                           .replace(/(\d{4})(\d)/,'$1-$2')
              },
          }"
          novalidate>
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 overflow-hidden">

            {{-- ── Coluna principal (2/3) ───────────────────────── --}}
            <div class="xl:col-span-2">

                {{-- Abas --}}
                <x-ui.tabs
                    :tabs="[
                        ['key'=>'pessoa',  'label'=>'Dados Pessoais', 'icon'=>'user'],
                        ['key'=>'empresa', 'label'=>'Empresa',        'icon'=>'building',
                         'badge'=>'companyName || cnpj || logoPreview'],
                    ]"
                    default="pessoa"
                    alpine="tab"
                    class="bg-white rounded-2xl shadow-sm border border-slate-100"
                >

                    {{-- ── Pane: Dados Pessoais ─────────────────── --}}
                    <x-ui.tab-pane key="pessoa" alpine="tab">

                        <x-ui.form-section
                            title="Identificação"
                            description="Informações pessoais do usuário"
                        />

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div class="sm:col-span-2">
                                <x-ui.input
                                    label="Nome completo"
                                    name="name"
                                    placeholder="Ex: Maria Silva"
                                    icon="user"
                                    :required="true"
                                    x-model="userName"
                                />
                            </div>

                            <x-ui.input
                                label="E-mail"
                                name="email"
                                type="email"
                                placeholder="usuario@exemplo.com"
                                icon="mail"
                                :required="true"
                                hint="Usado para login e notificações"
                            />

                            <x-ui.input
                                label="Telefone"
                                name="phone"
                                type="tel"
                                placeholder="(00) 00000-0000"
                                icon="phone"
                                hint="Opcional"
                            />

                        </div>

                        {{-- Segurança --}}
                        <div class="mt-6 pt-6 border-t border-slate-100">
                            <x-ui.form-section
                                title="Segurança"
                                description="Defina a senha de acesso"
                            />

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <x-ui.password-input
                                    label="Senha"
                                    name="password"
                                    placeholder="Mínimo 8 caracteres"
                                    :required="true"
                                    :showStrength="true"
                                    x-model="password"
                                />

                                <x-ui.password-input
                                    label="Confirmar senha"
                                    name="password_confirmation"
                                    placeholder="Repita a senha"
                                    :required="true"
                                />
                            </div>
                        </div>

                        {{-- Botão avançar --}}
                        <div class="mt-6 flex justify-end">
                            <button type="button"
                                    @click="tab = 'empresa'"
                                    class="inline-flex items-center gap-2 px-5 py-2.5
                                           bg-blue-50 hover:bg-blue-100 text-blue-600
                                           text-sm font-semibold rounded-xl transition-all duration-150">
                                Próximo: Empresa
                                <x-ui.icon name="arrow-right" class="w-4 h-4" />
                            </button>
                        </div>

                    </x-ui.tab-pane>

                    {{-- ── Pane: Empresa ───────────────────────── --}}
                    <x-ui.tab-pane key="empresa" alpine="tab">

                        <x-ui.form-section
                            title="Dados da Empresa"
                            description="Informações da empresa vinculada ao usuário"
                        />

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div class="sm:col-span-2">
                                <x-ui.input
                                    label="Razão Social"
                                    name="company_name"
                                    placeholder="Ex: Acme Tecnologia Ltda"
                                    icon="building"
                                    hint="Nome oficial registrado"
                                    x-model="companyName"
                                />
                            </div>

                            <x-ui.input
                                label="CNPJ"
                                name="cnpj"
                                placeholder="00.000.000/0000-00"
                                icon="hash"
                                maxlength="18"
                                hint="Formatado automaticamente"
                                x-model="cnpj"
                                x-on:input="cnpj = formatCnpj($event.target.value)"
                            />

                            <x-ui.input
                                label="Nome Fantasia"
                                name="trade_name"
                                placeholder="Ex: Acme Tech"
                                hint="Opcional"
                            />

                            <x-ui.input
                                label="Site"
                                name="website"
                                type="url"
                                placeholder="https://empresa.com.br"
                                icon="globe"
                                hint="Opcional"
                            />

                            <x-ui.input
                                label="Telefone comercial"
                                name="company_phone"
                                type="tel"
                                placeholder="(00) 0000-0000"
                                icon="phone"
                                hint="Opcional"
                            />

                            <div class="sm:col-span-2">
                                <x-ui.input
                                    label="Endereço"
                                    name="address"
                                    placeholder="Rua, número, bairro, cidade — UF"
                                    icon="map-pin"
                                    hint="Opcional"
                                />
                            </div>

                        </div>

                        {{-- Logo upload --}}
                        <div class="mt-6 pt-6 border-t border-slate-100">
                            <x-ui.form-section
                                title="Logotipo"
                                description="Imagem de identificação visual da empresa"
                            />

                            <x-ui.logo-upload
                                name="company_logo"
                                label="Logo da empresa"
                                x-on:change="logoPreview = $event.detail ?? null"
                            />
                        </div>

                        {{-- Observações --}}
                        <div class="mt-6 pt-6 border-t border-slate-100">
                            <x-ui.form-section
                                title="Observações"
                                description="Informações adicionais"
                            />
                            <x-ui.textarea
                                label="Notas internas"
                                name="notes"
                                placeholder="Escreva qualquer observação relevante sobre este usuário ou empresa..."
                                :rows="3"
                                hint="Visível apenas para administradores"
                            />
                        </div>

                        {{-- Botão voltar --}}
                        <div class="mt-6 flex justify-start">
                            <button type="button"
                                    @click="tab = 'pessoa'"
                                    class="inline-flex items-center gap-2 px-5 py-2.5
                                           bg-slate-50 hover:bg-slate-100 text-slate-600
                                           text-sm font-semibold rounded-xl border border-slate-200
                                           transition-all duration-150">
                                <x-ui.icon name="arrow-left" class="w-4 h-4" />
                                Voltar
                            </button>
                        </div>

                    </x-ui.tab-pane>

                </x-ui.tabs>
            </div>

            {{-- ── Coluna lateral (1/3) ─────────────────────────── --}}
            <div class="space-y-5">

                {{-- Prévia do usuário/empresa --}}
                <x-ui.avatar-preview
                    nameVar="userName"
                    companyVar="companyName"
                    cnpjVar="cnpj"
                    logoVar="logoPreview"
                />

                {{-- Checklist de progresso --}}
                <x-ui.progress-checklist
                    :items="[
                        ['label' => 'Nome preenchido',  'condition' => 'userName'],
                        ['label' => 'Senha válida',     'condition' => 'password && password.length >= 8'],
                        ['label' => 'Empresa vinculada','condition' => 'companyName'],
                        ['label' => 'CNPJ informado',   'condition' => 'cnpj'],
                        ['label' => 'Logo enviada',     'condition' => 'logoPreview'],
                    ]"
                />

                {{-- Status e perfil --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <x-ui.form-section
                        title="Configurações"
                        description="Permissões e status da conta"
                    />

                    <div class="space-y-4">
                        <x-ui.select
                            label="Status"
                            name="status"
                            :required="true"
                            :options="[
                                'active'   => 'Ativo',
                                'pending'  => 'Pendente',
                                'inactive' => 'Inativo',
                            ]"
                        />

                        <x-ui.select
                            label="Perfil de acesso"
                            name="role"
                            :required="true"
                            :options="[
                                'user'  => 'Usuário',
                                'admin' => 'Administrador',
                            ]"
                        />
                    </div>
                </div>

                {{-- Botões de ação --}}
                <x-ui.form-actions
                    submitLabel="Cadastrar Usuário"
                    icon="check-circle"
                    :cancelHref="route('admin.config.index')"
                    cancelLabel="Cancelar"
                />

            </div>
        </div>

    </form>

</x-layouts.app>

