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

const visibleSections = ref(new Set());
const observer = ref(null);

onMounted(() => {
    setTimeout(() => {
        visibleSections.value.add('hero');
    }, 300);

    observer.value = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.getAttribute('data-section-id');
                    if (sectionId) {
                        visibleSections.value.add(sectionId);

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
    <Head title="eadLEX - Plataforma Premium de Estudos Jurídicos" />

    <div class="min-h-screen bg-[#F8F7F4]">

        <!-- Header / Navbar -->
        <header class="fixed top-0 left-0 right-0 z-50 bg-[#FBFAF6]/95 backdrop-blur-md border-b border-[rgba(26,37,64,0.08)]">
            <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="/images/eadlex.png" alt="eadLEX" class="h-10 w-auto" />
                </div>
                <div class="hidden md:flex items-center gap-8">
                    <button
                        @click="scrollToSection('como-funciona')"
                        class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#5E6675] hover:text-[#1A2540] transition-colors"
                    >
                        Como Funciona
                    </button>
                    <button
                        @click="scrollToSection('planos')"
                        class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#5E6675] hover:text-[#1A2540] transition-colors"
                    >
                        Planos
                    </button>
                    <Link
                        :href="'https://aluno.eadlex.com.br/login'"
                        class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#5E6675] hover:text-[#1A2540] transition-colors"
                    >
                        Entrar
                    </Link>
                    <Link
                        :href="'https://aluno.eadlex.com.br/register'"
                        class="inline-flex items-center justify-center gap-2 min-h-[40px] px-5 rounded-[10px] border border-[#C89A2B] bg-[#C89A2B] text-white text-sm font-semibold hover:bg-[#B58721] hover:border-[#B58721] transition-colors"
                    >
                        Criar Conta
                    </Link>
                </div>
            </nav>
        </header>

        <!-- Hero Section -->
        <section
            data-section-id="hero"
            :class="['pt-32 pb-24 px-6 bg-[#FBFAF6]', { 'section-visible': isVisible('hero') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center hero-content">
                    <span aria-hidden="true" class="block h-px w-[40px] bg-[#C89A2B] mb-3 mx-auto"></span>
                    <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-6">Plataforma Jurídica Premium</p>
                    <h1 class="font-serif-display font-bold text-[#1A2540] text-5xl md:text-6xl lg:text-7xl leading-tight mb-6">
                        A Plataforma Jurídica Premium que<br />
                        <em class="not-italic text-[#C89A2B]">Eleva sua Performance</em><br />
                        em Concursos, OAB e Direito
                    </h1>
                    <p class="text-lg md:text-xl text-[#5E6675] mb-10 max-w-3xl mx-auto leading-relaxed">
                        Aprenda com professores de alta performance criados por Inteligência Artificial, receba explicações detalhadas, resolva questões, avance em níveis e desenvolva as competências exigidas nas provas mais desafiadoras do país.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <Link
                            :href="'https://aluno.eadlex.com.br/register'"
                            class="inline-flex items-center justify-center gap-2 min-h-[52px] px-8 rounded-[10px] border border-[#C89A2B] bg-[#C89A2B] text-white text-sm font-semibold hover:bg-[#B58721] hover:border-[#B58721] transition-colors"
                        >
                            <Rocket class="w-5 h-5" />
                            Começar Agora
                        </Link>
                        <button
                            @click="scrollToSection('como-funciona')"
                            class="inline-flex items-center justify-center gap-2 min-h-[52px] px-8 rounded-[10px] border border-[rgba(26,37,64,0.2)] bg-white text-[#1A2540] text-sm font-semibold hover:bg-[#F8F7F4] transition-colors"
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
            :class="['py-20 px-6', { 'section-visible': isVisible('proposta') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-12 section-content">
                    <span aria-hidden="true" class="block h-px w-[40px] bg-[#C89A2B] mb-3 mx-auto"></span>
                    <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-2">Nossa Missão</p>
                    <h2 class="font-serif-display font-bold text-[#1A2540] text-3xl md:text-4xl mb-6">
                        Proposta de Valor
                    </h2>
                    <p class="text-lg text-[#5E6675] max-w-4xl mx-auto leading-relaxed">
                        A <span class="font-semibold text-[#1A2540]">eadLEX</span> oferece um ecossistema de aprendizagem jurídica inovador, combinando trilhas estruturadas, tecnologia educacional especializada e professores IA capazes de corrigir questões, explicar fundamentos e orientar o raciocínio jurídico com precisão.
                    </p>
                    <p class="text-base text-[#5E6675] mt-4 max-w-3xl mx-auto">
                        Nossa solução foi projetada para quem busca aprovação em concursos públicos, excelência acadêmica, e preparação consistente para o Exame da Ordem.
                    </p>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-12">
                    <div
                        v-for="(stat, index) in [
                            { value: 'Níveis', label: 'Progressão contínua' },
                            { value: 'XP', label: 'Experiência acumulada' },
                            { value: 'Badges', label: 'Conquistas desbloqueadas' },
                            { value: 'Dashboard', label: 'Desempenho detalhado' }
                        ]"
                        :key="index"
                        class="text-center"
                    >
                        <div class="font-serif-display text-3xl font-bold text-[#C89A2B] mb-1">{{ stat.value }}</div>
                        <div class="font-mono-tech text-[10px] uppercase tracking-[0.12em] text-[#5E6675]">{{ stat.label }}</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Professores IA -->
        <section
            data-section-id="professores"
            :class="['py-20 px-6 bg-[#FBFAF6]', { 'section-visible': isVisible('professores') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16 section-content">
                    <span aria-hidden="true" class="block h-px w-[40px] bg-[#C89A2B] mb-3 mx-auto"></span>
                    <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-2">Inteligência Artificial</p>
                    <h2 class="font-serif-display font-bold text-[#1A2540] text-3xl md:text-4xl mb-4">
                        Professores IA: Especialistas que Corrigem, Explicam e Apontam o Caminho
                    </h2>
                    <p class="text-lg text-[#5E6675] max-w-3xl mx-auto">
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
                        class="professor-card rounded-[14px] bg-white border border-[rgba(26,37,64,0.08)] shadow-[0_2px_6px_rgba(26,37,64,0.06)] p-7"
                    >
                        <div class="w-10 h-10 rounded-full bg-[#EAF0FA] flex items-center justify-center mb-4">
                            <component :is="card.icon" class="w-5 h-5 text-[#2F4D85]" />
                        </div>
                        <h3 class="font-serif-display text-xl font-bold text-[#1A2540] mb-3">{{ card.title }}</h3>
                        <p class="text-[#5E6675] leading-relaxed">{{ card.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Preview da Plataforma -->
        <section
            data-section-id="preview"
            :class="['py-20 px-6 relative overflow-hidden', { 'section-visible': isVisible('preview') }]"
        >
            <!-- Vídeo de Background -->
            <div class="absolute inset-0 z-0">
                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    class="w-full h-full object-cover"
                >
                    <source src="/videos/landing/background.mp4" type="video/mp4" />
                    <source src="/videos/landing/background.webm" type="video/webm" />
                </video>
                <div class="absolute inset-0 bg-[rgba(26,37,64,0.55)]"></div>
            </div>

            <div class="container mx-auto max-w-7xl relative z-10">
                <div class="text-center mb-16 section-content">
                    <span aria-hidden="true" class="block h-px w-[40px] bg-[#C89A2B] mb-3 mx-auto"></span>
                    <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-2">Interface</p>
                    <h2 class="font-serif-display font-bold text-white text-3xl md:text-4xl mb-4">
                        Veja Como é Por Dentro
                    </h2>
                    <p class="text-lg text-[#EAF0FA] max-w-3xl mx-auto">
                        Conheça a interface premium e intuitiva da plataforma eadLEX
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div
                        v-for="(screenshot, index) in [
                            { title: 'Dashboard de Progresso', desc: 'Acompanhe seu progresso, níveis e conquistas', image: '/images/screenshots/dashboard.png', icon: TrendingUp },
                            { title: 'Missões e Módulos', desc: 'Trilhas estruturadas com conteúdo completo', image: '/images/screenshots/missoes.png', icon: Target },
                            { title: 'Simulados Inteligentes', desc: 'Provas realistas por banca e área', image: '/images/screenshots/simulados.png', icon: FileText },
                            { title: 'Professores IA', desc: 'Explicações detalhadas e personalizadas', image: '/images/screenshots/professores-ia.png', icon: Brain },
                            { title: 'Sistema de Níveis', desc: 'Evolua ganhando XP e desbloqueando badges', image: '/images/screenshots/niveis.png', icon: Award },
                            { title: 'Competições', desc: 'Desafie-se e compare seu desempenho', image: '/images/screenshots/competicoes.png', icon: Star }
                        ]"
                        :key="index"
                        :data-card-index="index"
                        class="preview-card group relative overflow-hidden rounded-[14px] bg-white border border-[rgba(26,37,64,0.08)] shadow-[0_2px_6px_rgba(26,37,64,0.06)]"
                    >
                        <div class="relative h-56 bg-[#EAF0FA] overflow-hidden">
                            <img
                                :src="screenshot.image"
                                :alt="screenshot.title"
                                class="w-full h-full object-cover opacity-70 group-hover:opacity-90 transition-opacity duration-500"
                                @error="$event.target.style.display='none'; $event.target.nextElementSibling.classList.remove('hidden');"
                            />
                            <div class="hidden w-full h-full items-center justify-center bg-[#EAF0FA]">
                                <component :is="screenshot.icon" class="w-20 h-20 text-[#4E73B8] opacity-30" />
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-white/80 via-transparent to-transparent"></div>
                            <div class="absolute top-4 right-4 w-10 h-10 bg-[#EAF0FA] rounded-full flex items-center justify-center border border-[rgba(26,37,64,0.08)]">
                                <component :is="screenshot.icon" class="w-5 h-5 text-[#2F4D85]" />
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-serif-display text-xl font-bold text-[#1A2540] mb-1 group-hover:text-[#C89A2B] transition-colors">
                                {{ screenshot.title }}
                            </h3>
                            <p class="text-sm text-[#5E6675]">{{ screenshot.desc }}</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-12 section-content">
                    <p class="text-[#EAF0FA] mb-6 text-lg">
                        Quer ver mais? Crie sua conta e explore todas as funcionalidades!
                    </p>
                    <Link
                        :href="'https://aluno.eadlex.com.br/register'"
                        class="inline-flex items-center justify-center gap-2 min-h-[52px] px-8 rounded-[10px] border border-[#C89A2B] bg-[#C89A2B] text-white text-sm font-semibold hover:bg-[#B58721] hover:border-[#B58721] transition-colors"
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
            :class="['py-20 px-6 bg-[#FBFAF6]', { 'section-visible': isVisible('como-funciona') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16 section-content">
                    <span aria-hidden="true" class="block h-px w-[40px] bg-[#C89A2B] mb-3 mx-auto"></span>
                    <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-2">Metodologia</p>
                    <h2 class="font-serif-display font-bold text-[#1A2540] text-3xl md:text-4xl mb-4">
                        Como Funciona a Plataforma
                    </h2>
                </div>
                <div class="grid md:grid-cols-2 gap-8">
                    <div
                        v-for="(card, index) in [
                            { icon: Target, num: '1.', title: 'Missões Jurídicas Estruturadas', desc: 'Trilhas estruturadas do básico ao avançado, com conteúdos, exercícios e desafios que fortalecem sua preparação.' },
                            { icon: Brain, num: '2.', title: 'Questões Comentadas por Professores IA', desc: 'Resoluções completas, análises de alternativas, citações normativas e orientação personalizada.' },
                            { icon: FileText, num: '3.', title: 'Simulados Inteligentes', desc: 'Provas modeladas nos principais concursos, banca por banca, e simulados exclusivos para o Exame da Ordem.' },
                            { icon: Award, num: '4.', title: 'Competências Jurídicas', desc: 'Desafios avançados que avaliam interpretação, argumentação e tomada de decisão — habilidades indispensáveis para concursos e para a OAB.' }
                        ]"
                        :key="index"
                        :data-card-index="index"
                        class="funciona-card rounded-[14px] bg-white border border-[rgba(26,37,64,0.08)] shadow-[0_2px_6px_rgba(26,37,64,0.06)] p-7"
                    >
                        <div class="flex items-center gap-4 mb-5">
                            <div class="w-14 h-14 bg-[#EAF0FA] rounded-full flex items-center justify-center flex-shrink-0">
                                <component :is="card.icon" class="w-7 h-7 text-[#2F4D85]" />
                            </div>
                            <h3 class="font-serif-display text-xl font-bold text-[#1A2540]">{{ card.num }} {{ card.title }}</h3>
                        </div>
                        <p class="text-[#5E6675] leading-relaxed">{{ card.desc }}</p>
                    </div>
                </div>

                <!-- Sistema de Evolução -->
                <div class="mt-10 rounded-md overflow-hidden bg-[#FBFAF6] border border-[rgba(26,37,64,0.08)] border-l-4 border-l-[#C89A2B] shadow-[0_1px_2px_rgba(0,0,0,0.04)] p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <TrendingUp class="w-6 h-6 text-[#C89A2B]" />
                        <h3 class="font-serif-display text-2xl font-bold text-[#1A2540]">Sistema de Evolução</h3>
                    </div>
                    <p class="text-[#5E6675] mb-6">Acompanhe sua jornada com:</p>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                        <div
                            v-for="(item, index) in [
                                { value: 'Níveis', label: 'Progressão contínua' },
                                { value: 'XP', label: 'Experiência acumulada' },
                                { value: 'Badges', label: 'Conquistas desbloqueadas' },
                                { value: 'Dashboard', label: 'Desempenho detalhado' },
                                { value: 'Histórico', label: 'Aprendizagem completa' }
                            ]"
                            :key="index"
                            class="text-center"
                        >
                            <div class="font-serif-display text-2xl font-bold text-[#C89A2B] mb-1">{{ item.value }}</div>
                            <div class="font-mono-tech text-[10px] uppercase tracking-[0.1em] text-[#5E6675]">{{ item.label }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Para Quem se Destina -->
        <section
            data-section-id="destina"
            :class="['py-20 px-6', { 'section-visible': isVisible('destina') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16 section-content">
                    <span aria-hidden="true" class="block h-px w-[40px] bg-[#C89A2B] mb-3 mx-auto"></span>
                    <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-2">Público-Alvo</p>
                    <h2 class="font-serif-display font-bold text-[#1A2540] text-3xl md:text-4xl mb-4">
                        Para Quem se Destina
                    </h2>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div
                        data-card-index="0"
                        class="destina-card rounded-[14px] bg-white border border-[rgba(26,37,64,0.08)] shadow-[0_2px_6px_rgba(26,37,64,0.06)] p-7"
                    >
                        <div class="w-12 h-12 bg-[#EAF0FA] rounded-full flex items-center justify-center mb-4">
                            <Users class="w-6 h-6 text-[#2F4D85]" />
                        </div>
                        <h3 class="font-serif-display text-xl font-bold text-[#1A2540] mb-3">Concurseiros</h3>
                        <p class="text-[#5E6675] leading-relaxed text-sm">
                            Ambiente completo para quem busca aprovação em carreiras jurídicas ou administrativas, com foco em resolução de questões, desempenho incremental e domínio de bancas.
                        </p>
                    </div>
                    <div
                        data-card-index="1"
                        class="destina-card rounded-[14px] bg-white border border-[rgba(26,37,64,0.08)] shadow-[0_2px_6px_rgba(26,37,64,0.06)] p-7"
                    >
                        <div class="w-12 h-12 bg-[#EAF0FA] rounded-full flex items-center justify-center mb-4">
                            <GraduationCap class="w-6 h-6 text-[#2F4D85]" />
                        </div>
                        <h3 class="font-serif-display text-xl font-bold text-[#1A2540] mb-3">Estudantes de Direito</h3>
                        <p class="text-[#5E6675] leading-relaxed text-sm">
                            Ferramentas para consolidar o conhecimento jurídico, reforçar fundamentos teóricos e ampliar a capacidade analítica.
                        </p>
                    </div>
                    <div
                        data-card-index="2"
                        class="destina-card rounded-[14px] bg-white border border-[rgba(26,37,64,0.08)] shadow-[0_2px_6px_rgba(26,37,64,0.06)] p-7"
                    >
                        <div class="w-12 h-12 bg-[#EAF0FA] rounded-full flex items-center justify-center mb-4">
                            <Award class="w-6 h-6 text-[#2F4D85]" />
                        </div>
                        <h3 class="font-serif-display text-xl font-bold text-[#1A2540] mb-3">Candidatos à OAB</h3>
                        <p class="text-[#5E6675] leading-relaxed text-sm">
                            Simulados estratégicos, análise de questões e explicações minuciosas para cada etapa da prova objetiva e discursiva.
                        </p>
                    </div>
                    <div
                        data-card-index="3"
                        class="destina-card rounded-[14px] bg-white border border-[rgba(26,37,64,0.08)] shadow-[0_2px_6px_rgba(26,37,64,0.06)] p-7"
                    >
                        <div class="w-12 h-12 bg-[#EAF0FA] rounded-full flex items-center justify-center mb-4">
                            <TrendingUp class="w-6 h-6 text-[#2F4D85]" />
                        </div>
                        <h3 class="font-serif-display text-xl font-bold text-[#1A2540] mb-3">Profissionais que desejam se aperfeiçoar</h3>
                        <p class="text-[#5E6675] leading-relaxed text-sm">
                            Aprimoramento contínuo em áreas essenciais, com suporte de professores IA e trilhas aprofundadas.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Por que Escolher -->
        <section
            data-section-id="escolher"
            :class="['py-20 px-6 bg-[#FBFAF6]', { 'section-visible': isVisible('escolher') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16 section-content">
                    <span aria-hidden="true" class="block h-px w-[40px] bg-[#C89A2B] mb-3 mx-auto"></span>
                    <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-2">Diferenciais</p>
                    <h2 class="font-serif-display font-bold text-[#1A2540] text-3xl md:text-4xl mb-4">
                        Por que Escolher a eadLEX
                    </h2>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div
                        v-for="(item, index) in [
                            { title: 'Professores IA especializados por área', desc: 'Expertise focada em cada disciplina jurídica.' },
                            { title: 'Explicações jurídicas completas e fundamentadas', desc: 'Conteúdo de alta qualidade acadêmica.' },
                            { title: 'Aprendizagem orientada por dados e métricas', desc: 'Acompanhamento detalhado do seu progresso.' },
                            { title: 'Sistema de progresso e engajamento', desc: 'Sistema de recompensas que motiva o estudo.' },
                            { title: 'Simulados realistas e questões no estilo das bancas', desc: 'Preparação alinhada com as provas reais.' },
                            { title: 'Evolução contínua e personalizada', desc: 'Adaptação ao seu ritmo de aprendizado.' },
                            { title: 'Plataforma responsiva, segura e atualizada', desc: 'Acesso de qualquer dispositivo, com segurança garantida.' }
                        ]"
                        :key="index"
                        :data-card-index="index"
                        class="escolher-card flex items-start gap-4 rounded-[14px] bg-white border border-[rgba(26,37,64,0.08)] shadow-[0_2px_6px_rgba(26,37,64,0.06)] p-6"
                    >
                        <CheckCircle2 class="w-5 h-5 text-[#15803d] flex-shrink-0 mt-0.5" />
                        <div>
                            <h3 class="font-serif-display text-base font-bold text-[#1A2540] mb-1">{{ item.title }}</h3>
                            <p class="text-sm text-[#5E6675]">{{ item.desc }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Planos de Acesso -->
        <section
            id="planos"
            data-section-id="planos"
            :class="['py-20 px-6', { 'section-visible': isVisible('planos') }]"
        >
            <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16 section-content">
                    <span aria-hidden="true" class="block h-px w-[40px] bg-[#C89A2B] mb-3 mx-auto"></span>
                    <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-2">Acesso</p>
                    <h2 class="font-serif-display font-bold text-[#1A2540] text-3xl md:text-4xl mb-4">
                        Planos de Acesso
                    </h2>
                </div>
                <div class="grid md:grid-cols-3 gap-8 items-start">

                    <!-- Plano Individual -->
                    <div
                        data-card-index="0"
                        class="planos-card rounded-[14px] bg-white border border-[rgba(26,37,64,0.08)] shadow-[0_2px_6px_rgba(26,37,64,0.06)] p-8"
                    >
                        <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-1">Individual</p>
                        <h3 class="font-serif-display text-xl font-bold text-[#1A2540] mb-1">Plano Individual</h3>
                        <p class="text-sm text-[#5E6675] mb-6">Acesso completo a:</p>
                        <ul class="space-y-3 mb-8">
                            <li v-for="benefit in ['Professores IA', 'Missões', 'Competências', 'Simulados', 'Banco de questões', 'Dashboard de performance']" :key="benefit" class="flex items-center gap-2 text-sm text-[#5E6675]">
                                <CheckCircle2 class="w-4 h-4 text-[#15803d] flex-shrink-0" />
                                {{ benefit }}
                            </li>
                        </ul>
                        <Link
                            :href="'https://aluno.eadlex.com.br/register'"
                            class="inline-flex items-center justify-center w-full min-h-[52px] px-6 rounded-[10px] border border-[rgba(26,37,64,0.2)] bg-white text-[#1A2540] text-sm font-semibold hover:bg-[#F8F7F4] transition-colors"
                        >
                            Escolher Plano
                        </Link>
                    </div>

                    <!-- Plano Preparatório OAB — Destaque -->
                    <div
                        data-card-index="1"
                        class="planos-card rounded-[14px] bg-white border-2 border-[#C89A2B] shadow-[0_16px_40px_rgba(200,154,43,0.18)] p-8"
                    >
                        <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-1 flex items-center gap-2">
                            <Star class="w-3.5 h-3.5" />
                            Mais Popular
                        </p>
                        <h3 class="font-serif-display text-xl font-bold text-[#1A2540] mb-1">Plano Preparatório OAB</h3>
                        <p class="text-sm text-[#5E6675] mb-6">Trilha exclusiva para todas as fases do exame:</p>
                        <ul class="space-y-3 mb-8">
                            <li v-for="benefit in ['Simulados estratégicos', 'Estatísticas detalhadas', 'Resoluções completas', 'Acompanhamento detalhado']" :key="benefit" class="flex items-center gap-2 text-sm text-[#5E6675]">
                                <CheckCircle2 class="w-4 h-4 text-[#15803d] flex-shrink-0" />
                                {{ benefit }}
                            </li>
                        </ul>
                        <Link
                            :href="'https://aluno.eadlex.com.br/register'"
                            class="inline-flex items-center justify-center w-full min-h-[52px] px-6 rounded-[10px] border border-[#C89A2B] bg-[#C89A2B] text-white text-sm font-semibold hover:bg-[#B58721] hover:border-[#B58721] transition-colors"
                        >
                            Escolher Plano
                        </Link>
                    </div>

                    <!-- Plano para Concursos -->
                    <div
                        data-card-index="2"
                        class="planos-card rounded-[14px] bg-white border border-[rgba(26,37,64,0.08)] shadow-[0_2px_6px_rgba(26,37,64,0.06)] p-8"
                    >
                        <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-1">Concursos</p>
                        <h3 class="font-serif-display text-xl font-bold text-[#1A2540] mb-1">Plano para Concursos</h3>
                        <p class="text-sm text-[#5E6675] mb-6">Conteúdos segmentados:</p>
                        <ul class="space-y-3 mb-8">
                            <li v-for="benefit in ['Por área e banca', 'Por carreira', 'Simulados modelados em provas reais']" :key="benefit" class="flex items-center gap-2 text-sm text-[#5E6675]">
                                <CheckCircle2 class="w-4 h-4 text-[#15803d] flex-shrink-0" />
                                {{ benefit }}
                            </li>
                        </ul>
                        <Link
                            :href="'https://aluno.eadlex.com.br/register'"
                            class="inline-flex items-center justify-center w-full min-h-[52px] px-6 rounded-[10px] border border-[rgba(26,37,64,0.2)] bg-white text-[#1A2540] text-sm font-semibold hover:bg-[#F8F7F4] transition-colors"
                        >
                            Escolher Plano
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA de Registro (substitui o formulário inline conforme README) -->
        <section
            data-section-id="registro"
            :class="['py-20 px-6 bg-[#FBFAF6]', { 'section-visible': isVisible('registro') }]"
        >
            <div class="container mx-auto max-w-2xl">
                <div class="rounded-[14px] bg-white border border-[rgba(26,37,64,0.08)] shadow-[0_2px_6px_rgba(26,37,64,0.06)] p-10 md:p-14 text-center">
                    <span aria-hidden="true" class="block h-px w-[40px] bg-[#C89A2B] mb-3 mx-auto"></span>
                    <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-2">Cadastro</p>
                    <h2 class="font-serif-display font-bold text-[#1A2540] text-3xl md:text-4xl mb-4">
                        Crie sua Conta Gratuitamente
                    </h2>
                    <p class="text-[#5E6675] text-lg mb-8">
                        Comece sua jornada de estudos agora mesmo
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link
                            :href="'https://aluno.eadlex.com.br/register'"
                            class="inline-flex items-center justify-center gap-2 min-h-[52px] px-8 rounded-[10px] border border-[#C89A2B] bg-[#C89A2B] text-white text-sm font-semibold hover:bg-[#B58721] hover:border-[#B58721] transition-colors"
                        >
                            <Rocket class="w-5 h-5" />
                            Criar Conta Gratuitamente
                        </Link>
                        <Link
                            :href="'https://aluno.eadlex.com.br/login'"
                            class="inline-flex items-center justify-center gap-2 min-h-[52px] px-8 rounded-[10px] border border-[rgba(26,37,64,0.2)] bg-white text-[#1A2540] text-sm font-semibold hover:bg-[#F8F7F4] transition-colors"
                        >
                            Já tenho conta
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Chamada Final -->
        <section
            data-section-id="chamada"
            :class="['py-24 px-6 bg-[#1A2540]', { 'section-visible': isVisible('chamada') }]"
        >
            <div class="container mx-auto max-w-4xl text-center section-content">
                <span aria-hidden="true" class="block h-px w-[40px] bg-[#C89A2B] mb-3 mx-auto"></span>
                <p class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#C89A2B] mb-6">Comece Hoje</p>
                <h2 class="font-serif-display font-bold text-white text-3xl md:text-5xl mb-6 leading-tight">
                    Estude com uma plataforma que combina rigor jurídico, tecnologia de ponta e experiência premium.
                </h2>
                <p class="text-xl text-[#EAF0FA] mb-10">
                    Aprovação e alta performance começam aqui.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Link
                        :href="'https://aluno.eadlex.com.br/register'"
                        class="inline-flex items-center justify-center gap-2 min-h-[52px] px-8 rounded-[10px] border border-[#C89A2B] bg-[#C89A2B] text-white text-sm font-semibold hover:bg-[#B58721] hover:border-[#B58721] transition-colors"
                    >
                        <Rocket class="w-5 h-5" />
                        Criar Conta Gratuitamente
                    </Link>
                    <Link
                        :href="'https://aluno.eadlex.com.br/login'"
                        class="inline-flex items-center justify-center gap-2 min-h-[52px] px-8 rounded-[10px] border border-[rgba(248,247,244,0.25)] bg-transparent text-[#F8F7F4] text-sm font-semibold hover:bg-[rgba(248,247,244,0.08)] transition-colors"
                    >
                        <FileText class="w-5 h-5" />
                        Testar um Simulado Agora
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 px-6 bg-[#1A2540] border-t border-[rgba(255,255,255,0.08)]">
            <div class="container mx-auto max-w-6xl">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-3">
                        <img src="/images/eadlex.png" alt="eadLEX" class="h-8 w-auto" />
                        <span class="font-serif-display text-xl font-bold text-white">eadLEX</span>
                    </div>
                    <div class="flex flex-wrap gap-8">
                        <Link
                            :href="'https://aluno.eadlex.com.br/login'"
                            class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#EAF0FA] hover:text-[#C89A2B] transition-colors"
                        >
                            Entrar
                        </Link>
                        <button
                            @click="scrollToSection('como-funciona')"
                            class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#EAF0FA] hover:text-[#C89A2B] transition-colors"
                        >
                            Como Funciona
                        </button>
                        <button
                            @click="scrollToSection('planos')"
                            class="font-mono-tech text-[11px] uppercase tracking-[0.15em] font-medium text-[#EAF0FA] hover:text-[#C89A2B] transition-colors"
                        >
                            Planos
                        </button>
                    </div>
                </div>
                <div class="mt-8 text-center font-mono-tech text-[10px] uppercase tracking-[0.1em] text-[rgba(234,240,250,0.45)]">
                    © 2025 eadLEX. Todos os direitos reservados.
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
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

/* Hero Section */
.hero-content {
    opacity: 0;
    transform: translateY(50px) scale(0.97);
    animation: heroFadeIn 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

@keyframes heroFadeIn {
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Cards de Professores IA */
.professor-card {
    opacity: 0;
    transform: translateY(40px);
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.professor-card.animate-in {
    opacity: 1;
    transform: translateY(0);
}

.professor-card:hover {
    border-color: rgba(200, 154, 43, 0.45);
    box-shadow: 0 6px 18px rgba(26, 37, 64, 0.12);
    transform: translateY(-4px);
}

/* Cards de Como Funciona */
.funciona-card {
    opacity: 0;
    transform: translateX(-24px);
    transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
}

.funciona-card.animate-in {
    opacity: 1;
    transform: translateX(0);
}

.funciona-card:nth-child(even) {
    transform: translateX(24px);
}

.funciona-card:nth-child(even).animate-in {
    transform: translateX(0);
}

.funciona-card:hover {
    border-color: rgba(200, 154, 43, 0.45);
    box-shadow: 0 6px 18px rgba(26, 37, 64, 0.12);
    transform: translateY(-4px);
}

/* Cards de Para Quem se Destina */
.destina-card {
    opacity: 0;
    transform: translateY(40px);
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.destina-card.animate-in {
    opacity: 1;
    transform: translateY(0);
}

.destina-card:hover {
    border-color: rgba(200, 154, 43, 0.45);
    box-shadow: 0 6px 18px rgba(26, 37, 64, 0.12);
    transform: translateY(-4px);
}

/* Cards de Por que Escolher */
.escolher-card {
    opacity: 0;
    transform: translateX(-16px);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.escolher-card.animate-in {
    opacity: 1;
    transform: translateX(0);
}

.escolher-card:hover {
    border-color: rgba(200, 154, 43, 0.45);
    box-shadow: 0 6px 18px rgba(26, 37, 64, 0.12);
}

/* Cards de Planos */
.planos-card {
    opacity: 0;
    transform: translateY(40px);
    transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
}

.planos-card.animate-in {
    opacity: 1;
    transform: translateY(0);
}

/* Cards de Preview */
.preview-card {
    opacity: 0;
    transform: translateY(40px);
    transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
}

.preview-card.animate-in {
    opacity: 1;
    transform: translateY(0);
}

.preview-card:hover {
    border-color: rgba(200, 154, 43, 0.45);
    box-shadow: 0 6px 18px rgba(26, 37, 64, 0.12);
    transform: translateY(-4px);
}

/* Delay escalonado */
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

@media (max-width: 768px) {
    section[data-section-id="preview"] video {
        opacity: 0.6;
    }
}
</style>
