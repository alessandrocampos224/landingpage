<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import { 
    AcademicCapIcon as GraduationCap,
    LightBulbIcon as Brain,
    ViewfinderCircleIcon as Target,
    TrophyIcon as Award,
    UsersIcon as Users,
    BookOpenIcon as BookOpen,
    DocumentTextIcon as FileText,
    CheckCircleIcon as CheckCircle2,
    ArrowRightIcon as ArrowRight,
    SparklesIcon as Sparkles,
    BoltIcon as Zap,
    ShieldCheckIcon as Shield,
    ChartBarIcon as TrendingUp,
    RocketLaunchIcon as Rocket,
    StarIcon as Star
} from '@heroicons/vue/24/outline';
import Input from '@/Components/Input.vue';
import InputError from '@/Components/InputError.vue';

const registerForm = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    from_landing: true,
});

const submitRegister = () => {
    registerForm.post('https://aluno.eadlex.com/register', {
        onFinish: () => registerForm.reset('password', 'password_confirmation'),
    });
};

const scrollToSection = (sectionId) => {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
};

// Estados de animação
const visibleSections = ref(new Set());
const observer = ref(null);

// Intersection Observer para animações
onMounted(() => {
    // Animação inicial do hero após um pequeno delay
    setTimeout(() => {
        visibleSections.value.add('hero');
    }, 300);

    // Configurar Intersection Observer
    observer.value = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.getAttribute('data-section-id');
                    if (sectionId) {
                        visibleSections.value.add(sectionId);
                        
                        // Animar cards dentro da seção com delay escalonado
                        const cards = entry.target.querySelectorAll('[data-card-index]');
                        cards.forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('animate-in');
                            }, index * 100);
                        });
                    }
                }
            });
        },
        {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px',
        }
    );

    // Observar todas as seções
    const sections = document.querySelectorAll('[data-section-id]');
    sections.forEach((section) => {
        observer.value.observe(section);
    });
});

onUnmounted(() => {
    if (observer.value) {
        observer.value.disconnect();
    }
});

const isVisible = (sectionId) => {
    return visibleSections.value.has(sectionId);
};
</script>

<template>
    <Head title="eadLEX - Plataforma Gamificada de Estudos Jurídicos" />
    
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900">
        <!-- Header/Navbar -->
        <header class="fixed top-0 left-0 right-0 z-50 bg-slate-900/80 backdrop-blur-md border-b border-blue-500/20">
            <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <img src="/images/auth-logo.png" alt="eadLEX" class="h-10 w-auto" />
                    <!-- <span class="text-2xl font-bold text-white">eadLEX</span> -->
                </div>
                <div class="hidden md:flex items-center gap-6">
                    <button @click="scrollToSection('como-funciona')" class="text-gray-300 hover:text-[#7AD988] transition-colors">
                        Como Funciona
                    </button>
                    <button @click="scrollToSection('planos')" class="text-gray-300 hover:text-[#7AD988] transition-colors">
                        Planos
                    </button>
                    <Link :href="'https://aluno.eadlex.com/login'" class="text-gray-300 hover:text-[#7AD988] transition-colors">
                        Entrar
                    </Link>
                    <Link 
                        :href="'https://aluno.eadlex.com/login'" 
                        class="px-6 py-2 bg-[#132579] text-white rounded-lg hover:bg-[#1a3199] transition-colors font-semibold"
                    >
                        Começar Agora
                    </Link>
                </div>
            </nav>
        </header>

        <!-- Hero Section -->
        <section 
            data-section-id="hero"
            :class="['pt-32 pb-20 px-4', { 'section-visible': isVisible('hero') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16 hero-content">
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight hero-title">
                        A Plataforma Gamificada que 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#7AD988] to-[#23C13A]">
                            Eleva sua Performance
                        </span>
                        <br />
                        em Concursos, Exame da OAB e Estudos Jurídicos Avançados
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-4xl mx-auto leading-relaxed">
                        Aprenda com professores de alta performance criados por Inteligência Artificial, receba explicações detalhadas, resolva questões, avance em níveis e desenvolva as competências exigidas nas provas mais desafiadoras do país.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <Link 
                            :href="'https://aluno.eadlex.com/login'" 
                            class="px-8 py-4 bg-gradient-to-r from-[#7AD988] to-[#23C13A] text-black rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-[#7AD988]/50 transition-all transform hover:scale-105 flex items-center gap-2"
                        >
                            <Rocket class="w-5 h-5" />
                            Começar Agora
                        </Link>
                        <button 
                            @click="scrollToSection('como-funciona')"
                            class="px-8 py-4 bg-transparent border-2 border-[#7AD988] text-[#7AD988] rounded-xl font-bold text-lg hover:bg-[#7AD988]/10 transition-all flex items-center gap-2"
                        >
                            <BookOpen class="w-5 h-5" />
                            Conhecer a Plataforma
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Proposta de Valor -->
        <section 
            data-section-id="proposta"
            :class="['py-20 px-4 bg-slate-800/50', { 'section-visible': isVisible('proposta') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-12 section-content">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Proposta de Valor
                    </h2>
                    <p class="text-xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
                        A <span class="text-[#7AD988] font-semibold">eadLEX</span> oferece um ecossistema de aprendizagem jurídica inovador, combinando gamificação, tecnologia educacional especializada e professores IA capazes de corrigir questões, explicar fundamentos e orientar o raciocínio jurídico com precisão.
                    </p>
                    <p class="text-lg text-gray-400 mt-6 max-w-3xl mx-auto">
                        Nossa solução foi projetada para quem busca aprovação em concursos públicos, excelência acadêmica, e preparação consistente para o Exame da Ordem.
                    </p>
                </div>
            </div>
        </section>

        <!-- Professores IA -->
        <section 
            data-section-id="professores"
            :class="['py-20 px-4', { 'section-visible': isVisible('professores') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16 section-content">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Professores IA: Especialistas que Corrigem, Explicam e Apontam o Caminho
                    </h2>
                    <p class="text-xl text-gray-300 max-w-4xl mx-auto mb-12">
                        Os professores IA eadLEX foram desenvolvidos para atuar como mestres jurídicos altamente qualificados.
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div 
                        v-for="(card, index) in [
                            { icon: CheckCircle2, title: 'Corrigem questões com rigor técnico', desc: 'Análise precisa e fundamentada de cada resposta.' },
                            { icon: Brain, title: 'Explicam passo a passo o raciocínio jurídico', desc: 'Orientações claras sobre o pensamento esperado.' },
                            { icon: FileText, title: 'Indicam os fundamentos legais pertinentes', desc: 'Citações normativas e referências precisas.' },
                            { icon: Shield, title: 'Apontam erros comuns e mostram como evitá-los', desc: 'Prevenção de equívocos frequentes.' },
                            { icon: Target, title: 'Auxiliam na preparação para concursos e OAB', desc: 'Suporte completo para provas objetivas e discursivas.' },
                            { icon: Zap, title: 'Disponibilidade imediata. Precisão acadêmica.', desc: 'Aprendizagem contínua, 24 horas por dia.' }
                        ]"
                        :key="index"
                        :data-card-index="index"
                        class="professor-card bg-slate-800/50 p-6 rounded-xl border border-blue-500/20 hover:border-[#7AD988]/50 transition-all"
                    >
                        <component :is="card.icon" class="w-10 h-10 text-[#7AD988] mb-4" />
                        <h3 class="text-xl font-bold text-white mb-3">{{ card.title }}</h3>
                        <p class="text-gray-300">{{ card.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Preview da Plataforma -->
        <section 
            data-section-id="preview"
            :class="['py-20 px-4 relative overflow-hidden', { 'section-visible': isVisible('preview') }]"
        >
            <!-- Vídeo de Background -->
            <div class="absolute inset-0 z-0">
                <video 
                    autoplay 
                    muted 
                    loop 
                    playsinline
                    class="w-full h-full object-cover opacity-30"
                >
                    <source src="/videos/landing/background.mp4" type="video/mp4" />
                    <source src="/videos/landing/background.webm" type="video/webm" />
                    <!-- Fallback se vídeo não existir -->
                </video>
                <!-- Overlay gradiente para melhorar legibilidade -->
                <div class="absolute inset-0 bg-gradient-to-br from-slate-900/90 via-blue-900/80 to-slate-900/90"></div>
                <!-- Efeito de partículas animadas -->
                <div class="absolute inset-0">
                    <div class="particle-bg"></div>
                </div>
            </div>
            
            <div class="container mx-auto max-w-7xl relative z-10">
                <div class="text-center mb-16 section-content">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Veja Como é Por Dentro
                    </h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                        Conheça a interface gamificada e intuitiva da plataforma eadLEX
                    </p>
                </div>
                
                <!-- Grid de Screenshots -->
                <!-- 
                    INSTRUÇÕES: Para adicionar screenshots reais da plataforma:
                    1. Coloque as imagens em /public/images/screenshots/
                    2. Nomeie as imagens como: dashboard.png, missoes.png, simulados.png, etc.
                    3. Atualize os caminhos no array abaixo
                    4. Recomendado: imagens em formato PNG ou JPG, resolução 1920x1080 ou similar
                -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div 
                        v-for="(screenshot, index) in [
                            { 
                                title: 'Dashboard Gamificado', 
                                desc: 'Acompanhe seu progresso, níveis e conquistas',
                                image: '/images/screenshots/dashboard.png', // Coloque sua screenshot aqui
                                icon: TrendingUp
                            },
                            { 
                                title: 'Missões e Módulos', 
                                desc: 'Trilhas estruturadas com conteúdo completo',
                                image: '/images/screenshots/missoes.png', // Coloque sua screenshot aqui
                                icon: Target
                            },
                            { 
                                title: 'Simulados Inteligentes', 
                                desc: 'Provas realistas por banca e área',
                                image: '/images/screenshots/simulados.png', // Coloque sua screenshot aqui
                                icon: FileText
                            },
                            { 
                                title: 'Professores IA', 
                                desc: 'Explicações detalhadas e personalizadas',
                                image: '/images/screenshots/professores-ia.png', // Coloque sua screenshot aqui
                                icon: Brain
                            },
                            { 
                                title: 'Sistema de Níveis', 
                                desc: 'Evolua ganhando XP e desbloqueando badges',
                                image: '/images/screenshots/niveis.png', // Coloque sua screenshot aqui
                                icon: Award
                            },
                            { 
                                title: 'Competições', 
                                desc: 'Desafie-se e compare seu desempenho',
                                image: '/images/screenshots/competicoes.png', // Coloque sua screenshot aqui
                                icon: Star
                            }
                        ]"
                        :key="index"
                        :data-card-index="index"
                        class="preview-card group relative overflow-hidden rounded-2xl border-2 border-blue-500/20 hover:border-[#7AD988]/50 transition-all duration-500"
                    >
                        <!-- Imagem de fundo -->
                        <div class="relative h-64 bg-gradient-to-br from-slate-800 to-slate-900 overflow-hidden">
                            <img 
                                :src="screenshot.image" 
                                :alt="screenshot.title"
                                class="w-full h-full object-cover opacity-60 group-hover:opacity-80 transition-opacity duration-500 group-hover:scale-110 transition-transform duration-700"
                                @error="$event.target.style.display='none'; $event.target.nextElementSibling.classList.remove('hidden');"
                            />
                            <!-- Fallback se imagem não existir -->
                            <div class="hidden w-full h-full items-center justify-center bg-gradient-to-br from-[#132579] to-slate-800">
                                <component :is="screenshot.icon" class="w-24 h-24 text-[#7AD988]/30" />
                            </div>
                            
                            <!-- Overlay com gradiente -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent"></div>
                            
                            <!-- Ícone flutuante -->
                            <div class="absolute top-4 right-4 w-12 h-12 bg-[#7AD988]/20 rounded-full flex items-center justify-center backdrop-blur-sm border border-[#7AD988]/30 group-hover:bg-[#7AD988]/30 group-hover:scale-110 transition-all">
                                <component :is="screenshot.icon" class="w-6 h-6 text-[#7AD988]" />
                            </div>
                        </div>
                        
                        <!-- Conteúdo do card -->
                        <div class="p-6 bg-slate-800/80 backdrop-blur-sm">
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-[#7AD988] transition-colors">
                                {{ screenshot.title }}
                            </h3>
                            <p class="text-gray-400 text-sm">
                                {{ screenshot.desc }}
                            </p>
                        </div>
                        
                        <!-- Efeito de brilho no hover -->
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-[#7AD988]/10 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        </div>
                    </div>
                </div>
                
                <!-- CTA -->
                <div class="text-center mt-12 section-content">
                    <p class="text-gray-300 mb-6 text-lg">
                        Quer ver mais? Crie sua conta e explore todas as funcionalidades!
                    </p>
                    <Link 
                        :href="'https://aluno.eadlex.com/login'" 
                        class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-[#7AD988] to-[#23C13A] text-black rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-[#7AD988]/50 transition-all transform hover:scale-105"
                    >
                        <Rocket class="w-5 h-5" />
                        Começar Agora
                    </Link>
                </div>
            </div>
        </section>

        <!-- Como Funciona -->
        <section 
            id="como-funciona"
            data-section-id="como-funciona"
            :class="['py-20 px-4 bg-slate-800/50', { 'section-visible': isVisible('como-funciona') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16 section-content">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Como Funciona a Plataforma
                    </h2>
                </div>
                <div class="grid md:grid-cols-2 gap-8">
                    <div 
                        v-for="(card, index) in [
                            { icon: Target, num: '1.', title: 'Missões Jurídicas Gamificadas', desc: 'Trilhas estruturadas do básico ao avançado, com conteúdos, exercícios e desafios que fortalecem sua preparação.' },
                            { icon: Brain, num: '2.', title: 'Questões Comentadas por Professores IA', desc: 'Resoluções completas, análises de alternativas, citações normativas e orientação personalizada.' },
                            { icon: FileText, num: '3.', title: 'Simulados Inteligentes', desc: 'Provas modeladas nos principais concursos, banca por banca, e simulados exclusivos para o Exame da Ordem.' },
                            { icon: Award, num: '4.', title: 'Competências Jurídicas', desc: 'Desafios avançados que avaliam interpretação, argumentação e tomada de decisão — habilidades indispensáveis para concursos e para a OAB.' }
                        ]"
                        :key="index"
                        :data-card-index="index"
                        class="funciona-card bg-gradient-to-br from-[#132579] to-slate-800 p-8 rounded-xl border border-blue-500/30"
                    >
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-[#7AD988]/20 rounded-full flex items-center justify-center">
                                <component :is="card.icon" class="w-8 h-8 text-[#7AD988]" />
                            </div>
                            <h3 class="text-2xl font-bold text-white">{{ card.num }} {{ card.title }}</h3>
                        </div>
                        <p class="text-gray-300 text-lg leading-relaxed">
                            {{ card.desc }}
                        </p>
                    </div>
                </div>
                <div class="mt-12 bg-slate-800/70 p-8 rounded-xl border border-[#7AD988]/30">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                        <TrendingUp class="w-8 h-8 text-[#7AD988]" />
                        Sistema de Evolução
                    </h3>
                    <p class="text-gray-300 text-lg mb-4">
                        Acompanhe sua jornada com:
                    </p>
                    <div class="grid md:grid-cols-5 gap-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#7AD988] mb-2">Níveis</div>
                            <div class="text-gray-400">Progressão contínua</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#7AD988] mb-2">XP</div>
                            <div class="text-gray-400">Experiência acumulada</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#7AD988] mb-2">Badges</div>
                            <div class="text-gray-400">Conquistas desbloqueadas</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#7AD988] mb-2">Dashboard</div>
                            <div class="text-gray-400">Desempenho detalhado</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-[#7AD988] mb-2">Histórico</div>
                            <div class="text-gray-400">Aprendizagem completa</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Para Quem se Destina -->
        <section 
            data-section-id="destina"
            :class="['py-20 px-4', { 'section-visible': isVisible('destina') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16 section-content">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Para Quem se Destina
                    </h2>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div 
                        v-for="(card, index) in [
                            { icon: Users, title: 'Concurseiros', desc: 'Ambiente completo para quem busca aprovação em carreiras jurídicas ou administrativas, com foco em resolução de questões, desempenho incremental e domínio de bancas.' },
                            { icon: GraduationCap, title: 'Estudantes de Direito', desc: 'Ferramentas para consolidar o conhecimento jurídico, reforçar fundamentos teóricos e ampliar a capacidade analítica.' },
                            { icon: Award, title: 'Candidatos à OAB', desc: 'Simulados estratégicos, análise de questões e explicações minuciosas para cada etapa da prova objetiva e discursiva.' },
                            { icon: TrendingUp, title: 'Profissionais que desejam se aperfeiçoar', desc: 'Aprimoramento contínuo em áreas essenciais, com suporte de professores IA e trilhas aprofundadas.' }
                        ]"
                        :key="index"
                        :data-card-index="index"
                        class="destina-card bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-xl border border-blue-500/20 hover:border-[#7AD988]/50 transition-all transform hover:scale-105"
                    >
                        <Users class="w-12 h-12 text-[#7AD988] mb-4" />
                        <h3 class="text-2xl font-bold text-white mb-4">Concurseiros</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Ambiente completo para quem busca aprovação em carreiras jurídicas ou administrativas, com foco em resolução de questões, desempenho incremental e domínio de bancas.
                        </p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-xl border border-blue-500/20 hover:border-[#7AD988]/50 transition-all transform hover:scale-105">
                        <GraduationCap class="w-12 h-12 text-[#7AD988] mb-4" />
                        <h3 class="text-2xl font-bold text-white mb-4">Estudantes de Direito</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Ferramentas para consolidar o conhecimento jurídico, reforçar fundamentos teóricos e ampliar a capacidade analítica.
                        </p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-xl border border-blue-500/20 hover:border-[#7AD988]/50 transition-all transform hover:scale-105">
                        <Award class="w-12 h-12 text-[#7AD988] mb-4" />
                        <h3 class="text-2xl font-bold text-white mb-4">Candidatos à OAB</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Simulados estratégicos, análise de questões e explicações minuciosas para cada etapa da prova objetiva e discursiva.
                        </p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-xl border border-blue-500/20 hover:border-[#7AD988]/50 transition-all transform hover:scale-105">
                        <TrendingUp class="w-12 h-12 text-[#7AD988] mb-4" />
                        <h3 class="text-2xl font-bold text-white mb-4">Profissionais que desejam se aperfeiçoar</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Aprimoramento contínuo em áreas essenciais, com suporte de professores IA e trilhas aprofundadas.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Por que Escolher -->
        <section 
            data-section-id="escolher"
            :class="['py-20 px-4 bg-slate-800/50', { 'section-visible': isVisible('escolher') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16 section-content">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Por que Escolher a eadLEX
                    </h2>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div 
                        v-for="(item, index) in [
                            { title: 'Professores IA especializados por área', desc: 'Expertise focada em cada disciplina jurídica.' },
                            { title: 'Explicações jurídicas completas e fundamentadas', desc: 'Conteúdo de alta qualidade acadêmica.' },
                            { title: 'Aprendizagem orientada por dados e métricas', desc: 'Acompanhamento detalhado do seu progresso.' },
                            { title: 'Gamificação para aumentar disciplina e engajamento', desc: 'Sistema de recompensas que motiva o estudo.' },
                            { title: 'Simulados realistas e questões no estilo das bancas', desc: 'Preparação alinhada com as provas reais.' },
                            { title: 'Evolução contínua e personalizada', desc: 'Adaptação ao seu ritmo de aprendizado.' },
                            { title: 'Plataforma responsiva, segura e atualizada', desc: 'Acesso de qualquer dispositivo, com segurança garantida.' }
                        ]"
                        :key="index"
                        :data-card-index="index"
                        class="escolher-card flex items-start gap-4 bg-slate-800/50 p-6 rounded-xl border border-blue-500/20"
                    >
                        <CheckCircle2 class="w-6 h-6 text-[#7AD988] flex-shrink-0 mt-1" />
                        <div>
                            <h3 class="text-lg font-bold text-white mb-2">{{ item.title }}</h3>
                            <p class="text-gray-400">{{ item.desc }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Planos de Acesso -->
        <section 
            id="planos"
            data-section-id="planos"
            :class="['py-20 px-4', { 'section-visible': isVisible('planos') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16 section-content">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Planos de Acesso
                    </h2>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div 
                        data-card-index="0"
                        class="planos-card bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-xl border-2 border-blue-500/30 hover:border-[#7AD988]/50 transition-all"
                    >
                        <h3 class="text-2xl font-bold text-white mb-4">Plano Individual</h3>
                        <p class="text-gray-300 mb-6">Acesso completo a:</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Professores IA
                            </li>
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Missões
                            </li>
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Competências
                            </li>
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Simulados
                            </li>
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Banco de questões
                            </li>
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Dashboard de performance
                            </li>
                        </ul>
                        <Link 
                            :href="'https://aluno.eadlex.com/login'" 
                            class="block w-full text-center px-6 py-3 bg-[#132579] text-white rounded-lg hover:bg-[#1a3199] transition-colors font-semibold"
                        >
                            Escolher Plano
                        </Link>
                    </div>
                    <div 
                        data-card-index="1"
                        class="planos-card bg-gradient-to-br from-[#132579] to-slate-800 p-8 rounded-xl border-2 border-[#7AD988]/50 hover:border-[#7AD988] transition-all transform scale-105"
                    >
                        <div class="flex items-center gap-2 mb-4">
                            <Star class="w-6 h-6 text-[#7AD988]" />
                            <span class="text-sm font-bold text-[#7AD988] uppercase">Mais Popular</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Plano Preparatório OAB</h3>
                        <p class="text-gray-300 mb-6">Trilha exclusiva para todas as fases do exame:</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Simulados estratégicos
                            </li>
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Estatísticas detalhadas
                            </li>
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Resoluções completas
                            </li>
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Acompanhamento detalhado
                            </li>
                        </ul>
                        <Link 
                            :href="'https://aluno.eadlex.com/login'" 
                            class="block w-full text-center px-6 py-3 bg-gradient-to-r from-[#7AD988] to-[#23C13A] text-black rounded-lg hover:shadow-lg hover:shadow-[#7AD988]/50 transition-all font-bold"
                        >
                            Escolher Plano
                        </Link>
                    </div>
                    <div 
                        data-card-index="2"
                        class="planos-card bg-gradient-to-br from-slate-800 to-slate-900 p-8 rounded-xl border-2 border-blue-500/30 hover:border-[#7AD988]/50 transition-all"
                    >
                        <h3 class="text-2xl font-bold text-white mb-4">Plano para Concursos</h3>
                        <p class="text-gray-300 mb-6">Conteúdos segmentados:</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Por área e banca
                            </li>
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Por carreira
                            </li>
                            <li class="flex items-center gap-2 text-gray-300">
                                <CheckCircle2 class="w-5 h-5 text-[#7AD988]" />
                                Simulados modelados em provas reais
                            </li>
                        </ul>
                        <Link 
                            :href="'https://aluno.eadlex.com/login'" 
                            class="block w-full text-center px-6 py-3 bg-[#132579] text-white rounded-lg hover:bg-[#1a3199] transition-colors font-semibold"
                        >
                            Escolher Plano
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Formulário de Registro -->
        <section 
            data-section-id="registro"
            :class="['py-20 px-4 bg-slate-800/50', { 'section-visible': isVisible('registro') }]"
        >
            <div class="container mx-auto max-w-2xl">
                <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-8 md:p-12 rounded-2xl border-2 border-[#7AD988]/30 shadow-2xl">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                            Crie sua Conta Gratuitamente
                        </h2>
                        <p class="text-gray-300 text-lg">
                            Comece sua jornada de estudos agora mesmo
                        </p>
                    </div>
                    <form @submit.prevent="submitRegister" class="space-y-6">
                        <div>
                            <label class="block text-white font-semibold mb-2">Nome Completo</label>
                            <input
                                v-model="registerForm.name"
                                type="text"
                                required
                                class="w-full px-4 py-3 bg-slate-700 border-2 border-blue-500/30 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-[#7AD988] transition-colors"
                                placeholder="Seu nome completo"
                            />
                            <InputError :message="registerForm.errors.name" />
                        </div>
                        <div>
                            <label class="block text-white font-semibold mb-2">Email</label>
                            <input
                                v-model="registerForm.email"
                                type="email"
                                required
                                class="w-full px-4 py-3 bg-slate-700 border-2 border-blue-500/30 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-[#7AD988] transition-colors"
                                placeholder="seu.email@exemplo.com"
                            />
                            <InputError :message="registerForm.errors.email" />
                        </div>
                        <div>
                            <label class="block text-white font-semibold mb-2">Senha</label>
                            <input
                                v-model="registerForm.password"
                                type="password"
                                required
                                class="w-full px-4 py-3 bg-slate-700 border-2 border-blue-500/30 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-[#7AD988] transition-colors"
                                placeholder="Digite sua senha"
                            />
                            <InputError :message="registerForm.errors.password" />
                        </div>
                        <div>
                            <label class="block text-white font-semibold mb-2">Confirmar Senha</label>
                            <input
                                v-model="registerForm.password_confirmation"
                                type="password"
                                required
                                class="w-full px-4 py-3 bg-slate-700 border-2 border-blue-500/30 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-[#7AD988] transition-colors"
                                placeholder="Digite sua senha novamente"
                            />
                            <InputError :message="registerForm.errors.password_confirmation" />
                        </div>
                        <button
                            type="submit"
                            :disabled="registerForm.processing"
                            class="w-full px-8 py-4 bg-gradient-to-r from-[#7AD988] to-[#23C13A] text-black rounded-lg font-bold text-lg hover:shadow-lg hover:shadow-[#7AD988]/50 transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                        >
                            <Rocket v-if="!registerForm.processing" class="w-5 h-5" />
                            <span v-if="registerForm.processing">Criando conta...</span>
                            <span v-else>Criar Conta Gratuitamente</span>
                        </button>
                    </form>
                    <div class="mt-6 text-center">
                        <p class="text-gray-400">
                            Já tem uma conta?
                            <Link :href="'https://aluno.eadlex.com/login'" class="text-[#7AD988] hover:text-[#23C13A] font-semibold transition-colors">
                                Faça login
                            </Link>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Chamada Final -->
        <section 
            data-section-id="chamada"
            :class="['py-20 px-4', { 'section-visible': isVisible('chamada') }]"
        >
            <div class="container mx-auto max-w-4xl text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Estude com uma plataforma que combina rigor jurídico, tecnologia de ponta e gamificação avançada.
                </h2>
                <p class="text-2xl text-gray-300 mb-10">
                    Aprovação e alta performance começam aqui.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Link 
                        :href="'https://aluno.eadlex.com/login'" 
                        class="px-8 py-4 bg-gradient-to-r from-[#7AD988] to-[#23C13A] text-black rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-[#7AD988]/50 transition-all transform hover:scale-105 flex items-center justify-center gap-2"
                    >
                        <Rocket class="w-5 h-5" />
                        Criar Conta Gratuitamente
                    </Link>
                    <Link 
                        :href="'https://aluno.eadlex.com/login'" 
                        class="px-8 py-4 bg-transparent border-2 border-[#7AD988] text-[#7AD988] rounded-xl font-bold text-lg hover:bg-[#7AD988]/10 transition-all flex items-center justify-center gap-2"
                    >
                        <FileText class="w-5 h-5" />
                        Testar um Simulado Agora
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 px-4 bg-slate-900 border-t border-blue-500/20">
            <div class="container mx-auto max-w-6xl">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-2">
                        <img src="/images/auth-logo.png" alt="eadLEX" class="h-8 w-auto" />
                        <span class="text-xl font-bold text-white">eadLEX</span>
                    </div>
                    <div class="flex flex-wrap gap-6 text-gray-400">
                        <Link :href="'https://aluno.eadlex.com/login'" class="hover:text-[#7AD988] transition-colors">
                            Entrar
                        </Link>
                        <button @click="scrollToSection('como-funciona')" class="hover:text-[#7AD988] transition-colors">
                            Como Funciona
                        </button>
                        <button @click="scrollToSection('planos')" class="hover:text-[#7AD988] transition-colors">
                            Planos
                        </button>
                    </div>
                </div>
                <div class="mt-8 text-center text-gray-500 text-sm">
                    © 2025 eadLEX. Todos os direitos reservados.
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
/* ===========================
   ANIMAÇÕES GAMIFICADAS
   =========================== */

/* Animações de entrada para seções */
.section-content {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.section-visible .section-content {
    opacity: 1;
    transform: translateY(0);
}

/* Hero Section - Animação especial */
.hero-content {
    opacity: 0;
    transform: translateY(50px) scale(0.95);
    animation: heroFadeIn 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.section-visible .hero-content {
    animation-delay: 0.2s;
}

@keyframes heroFadeIn {
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.hero-title {
    animation: titleGlow 3s ease-in-out infinite;
}

@keyframes titleGlow {
    0%, 100% {
        text-shadow: 
            0 0 20px rgba(122, 217, 136, 0.5),
            0 0 40px rgba(122, 217, 136, 0.3);
    }
    50% {
        text-shadow: 
            0 0 30px rgba(122, 217, 136, 0.8),
            0 0 60px rgba(122, 217, 136, 0.5),
            0 0 80px rgba(122, 217, 136, 0.3);
    }
}

/* Cards de Professores IA */
.professor-card {
    opacity: 0;
    transform: translateY(40px) scale(0.9);
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.professor-card.animate-in {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.professor-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 
        0 10px 40px rgba(122, 217, 136, 0.3),
        0 0 60px rgba(122, 217, 136, 0.1);
    border-color: rgba(122, 217, 136, 0.8);
}

/* Cards de Como Funciona */
.funciona-card {
    opacity: 0;
    transform: translateX(-30px) rotateY(-10deg);
    transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
}

.funciona-card.animate-in {
    opacity: 1;
    transform: translateX(0) rotateY(0deg);
}

.funciona-card:nth-child(even) {
    transform: translateX(30px) rotateY(10deg);
}

.funciona-card:nth-child(even).animate-in {
    transform: translateX(0) rotateY(0deg);
}

.funciona-card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 
        0 15px 50px rgba(19, 37, 121, 0.4),
        0 0 80px rgba(122, 217, 136, 0.2);
    border-color: rgba(122, 217, 136, 0.6);
}

/* Cards de Para Quem se Destina */
.destina-card {
    opacity: 0;
    transform: translateY(50px) scale(0.85);
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.destina-card.animate-in {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.destina-card:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 
        0 20px 60px rgba(122, 217, 136, 0.4),
        0 0 100px rgba(122, 217, 136, 0.2);
}

/* Cards de Por que Escolher */
.escolher-card {
    opacity: 0;
    transform: translateX(-20px) scale(0.95);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.escolher-card.animate-in {
    opacity: 1;
    transform: translateX(0) scale(1);
}

.escolher-card:hover {
    transform: translateX(5px) scale(1.02);
    background: rgba(30, 41, 59, 0.8);
    border-color: rgba(122, 217, 136, 0.6);
    box-shadow: 0 8px 30px rgba(122, 217, 136, 0.2);
}

/* Efeitos de partículas no fundo */
section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 50%, rgba(122, 217, 136, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(19, 37, 121, 0.05) 0%, transparent 50%);
    pointer-events: none;
    opacity: 0;
    transition: opacity 1s ease;
}

.section-visible section::before {
    opacity: 1;
}

/* Animação de brilho nos ícones */
.professor-card svg,
.funciona-card svg,
.destina-card svg {
    filter: drop-shadow(0 0 8px rgba(122, 217, 136, 0.4));
    transition: all 0.3s ease;
}

.professor-card:hover svg,
.funciona-card:hover svg,
.destina-card:hover svg {
    filter: drop-shadow(0 0 15px rgba(122, 217, 136, 0.8));
    transform: scale(1.1) rotate(5deg);
}

/* Efeito de pulso nos botões */
button, a[href*="login"] {
    position: relative;
    overflow: hidden;
}

button::before, a[href*="login"]::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(122, 217, 136, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

button:hover::before, a[href*="login"]:hover::before {
    width: 300px;
    height: 300px;
}

/* Animação de entrada para planos */
.planos-card {
    opacity: 0;
    transform: translateY(40px) rotateX(15deg);
    transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
}

.planos-card.animate-in {
    opacity: 1;
    transform: translateY(0) rotateX(0deg);
}

/* Efeito de gradiente animado no fundo */
@keyframes gradientShift {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

.bg-gradient-to-br {
    background-size: 200% 200%;
    animation: gradientShift 15s ease infinite;
}

/* Responsividade */
@media (max-width: 768px) {
    .professor-card,
    .funciona-card,
    .destina-card,
    .escolher-card {
        transform: translateY(20px) scale(0.95);
    }
    
    .funciona-card {
        transform: translateY(20px);
    }
    
    .funciona-card:nth-child(even) {
        transform: translateY(20px);
    }
}

/* Delay escalonado para animações */
.professor-card[data-card-index="0"] { transition-delay: 0.1s; }
.professor-card[data-card-index="1"] { transition-delay: 0.2s; }
.professor-card[data-card-index="2"] { transition-delay: 0.3s; }
.professor-card[data-card-index="3"] { transition-delay: 0.4s; }
.professor-card[data-card-index="4"] { transition-delay: 0.5s; }
.professor-card[data-card-index="5"] { transition-delay: 0.6s; }

.funciona-card[data-card-index="0"] { transition-delay: 0.1s; }
.funciona-card[data-card-index="1"] { transition-delay: 0.2s; }
.funciona-card[data-card-index="2"] { transition-delay: 0.3s; }
.funciona-card[data-card-index="3"] { transition-delay: 0.4s; }

.destina-card[data-card-index="0"] { transition-delay: 0.1s; }
.destina-card[data-card-index="1"] { transition-delay: 0.2s; }
.destina-card[data-card-index="2"] { transition-delay: 0.3s; }
.destina-card[data-card-index="3"] { transition-delay: 0.4s; }

.planos-card[data-card-index="0"] { transition-delay: 0.1s; }
.planos-card[data-card-index="1"] { transition-delay: 0.2s; }
.planos-card[data-card-index="2"] { transition-delay: 0.3s; }

.escolher-card[data-card-index="0"] { transition-delay: 0.1s; }
.escolher-card[data-card-index="1"] { transition-delay: 0.15s; }
.escolher-card[data-card-index="2"] { transition-delay: 0.2s; }
.escolher-card[data-card-index="3"] { transition-delay: 0.25s; }
.escolher-card[data-card-index="4"] { transition-delay: 0.3s; }
.escolher-card[data-card-index="5"] { transition-delay: 0.35s; }
.escolher-card[data-card-index="6"] { transition-delay: 0.4s; }

/* Cards de Preview */
.preview-card {
    opacity: 0;
    transform: translateY(50px) scale(0.9) rotateY(-5deg);
    transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
}

.preview-card.animate-in {
    opacity: 1;
    transform: translateY(0) scale(1) rotateY(0deg);
}

.preview-card:hover {
    transform: translateY(-10px) scale(1.02) rotateY(2deg);
    box-shadow: 
        0 20px 60px rgba(122, 217, 136, 0.3),
        0 0 100px rgba(122, 217, 136, 0.1),
        inset 0 0 50px rgba(122, 217, 136, 0.05);
}

.preview-card:nth-child(even) {
    transform: translateY(50px) scale(0.9) rotateY(5deg);
}

.preview-card:nth-child(even).animate-in {
    transform: translateY(0) scale(1) rotateY(0deg);
}

.preview-card:nth-child(even):hover {
    transform: translateY(-10px) scale(1.02) rotateY(-2deg);
}

.preview-card[data-card-index="0"] { transition-delay: 0.1s; }
.preview-card[data-card-index="1"] { transition-delay: 0.2s; }
.preview-card[data-card-index="2"] { transition-delay: 0.3s; }
.preview-card[data-card-index="3"] { transition-delay: 0.4s; }
.preview-card[data-card-index="4"] { transition-delay: 0.5s; }
.preview-card[data-card-index="5"] { transition-delay: 0.6s; }

/* Vídeo de Background */
section[data-section-id="preview"] {
    position: relative;
}

section[data-section-id="preview"] video {
    filter: blur(0px);
    transition: filter 0.5s ease;
}

section[data-section-id="preview"]:hover video {
    filter: blur(1px);
}

/* Partículas animadas no background */
.particle-bg {
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(circle at 20% 30%, rgba(122, 217, 136, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(19, 37, 121, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(122, 217, 136, 0.05) 0%, transparent 70%);
    animation: particlePulse 8s ease-in-out infinite;
    pointer-events: none;
}

@keyframes particlePulse {
    0%, 100% {
        opacity: 0.5;
        transform: scale(1);
    }
    50% {
        opacity: 1;
        transform: scale(1.1);
    }
}

/* Efeito de brilho no overlay */
section[data-section-id="preview"]::before {
    content: '';
    position: absolute;
    inset: 0;
    background: 
        radial-gradient(circle at 30% 40%, rgba(122, 217, 136, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 70% 60%, rgba(19, 37, 121, 0.1) 0%, transparent 50%);
    pointer-events: none;
    z-index: 1;
    animation: overlayGlow 10s ease-in-out infinite;
}

@keyframes overlayGlow {
    0%, 100% {
        opacity: 0.3;
    }
    50% {
        opacity: 0.6;
    }
}

/* Responsividade do vídeo */
@media (max-width: 768px) {
    section[data-section-id="preview"] video {
        opacity: 0.2;
    }
    
    section[data-section-id="preview"] .particle-bg {
        opacity: 0.7;
    }
}
</style>

