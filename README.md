# Landing Page - eadLEX

Esta pasta contém todos os arquivos necessários para a landing page no domínio principal (eadlex.com.br).

## Estrutura

```
landingpage/
├── Index.vue              # Componente Vue (precisa build)
├── index.html             # HTML estático (NÃO precisa build) ⭐ RECOMENDADO
├── LandingPageController.php  # Controller Laravel (se usar Vue)
├── images/
│   └── screenshots/       # Screenshots da plataforma
├── videos/
│   └── landing/          # Vídeo de background
└── README.md             # Este arquivo
```

## ⚠️ IMPORTANTE: Vue vs HTML

### ❌ Vue (Index.vue) - Precisa Build
- Precisa: `npm install` + `npm run build` sempre que mudar
- Vantagem: Mantém todas as animações Vue
- Desvantagem: Mais complexo, precisa de build

### ✅ HTML Estático (index.html) - NÃO Precisa Build ⭐
- **NÃO precisa build** - só copiar e usar!
- Vantagem: Simples, rápido, sem dependências
- Desvantagem: Animações em CSS/JS puro (mas funcionam igual)

## Como Usar

### Opção 1: HTML Estático (RECOMENDADO - Sem Build) ⭐
1. Copie `index.html` para a raiz do seu servidor web
2. Copie as pastas `images/` e `videos/` para `public/` (ou raiz)
3. Ajuste os caminhos das imagens no HTML se necessário
4. Pronto! Funciona sem build

### Opção 2: Laravel + Inertia (Precisa Build)
1. Copie `Index.vue` para `resources/js/Pages/LandingPage/Index.vue`
2. Copie `LandingPageController.php` para `app/Http/Controllers/`
3. Copie as pastas `images/` e `videos/` para `public/`
4. Adicione a rota em `routes/web.php`:
   ```php
   Route::get('/', [LandingPageController::class, 'index'])->name('landing');
   ```
5. Execute: `npm install && npm run build`

## URLs Configuradas

Todos os links já estão configurados para apontar para:
- Login: `https://aluno.eadlex.com.br/login`
- Registro: `https://aluno.eadlex.com.br/register`

## Imagens e Vídeos

- Imagens: `/images/screenshots/`
- Vídeo: `/videos/landing/background.mp4`

## Notas

- ✅ **Formulário de registro removido da landing page** - Todos os CTAs redirecionam para `https://aluno.eadlex.com.br/register`
- Todos os botões "Começar Agora", "Escolher Plano" e "Criar Conta" redirecionam para a página de registro externa
- Todos os links de login redirecionam para `https://aluno.eadlex.com.br/login`
- **Use `index.html` se quiser evitar build!** ⭐

# landingpage
