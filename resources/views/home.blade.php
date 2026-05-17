@extends('layouts.app')
@section('title', 'MentorConnect - Find the Right Mentor. Build the Future.')

@section('styles')
<style>
  .hero-section{background:linear-gradient(160deg,#F7F9FC 0%,#EEF0FF 55%,#FFF5F0 100%);}
  .glow-violet{background:radial-gradient(circle,rgba(139,109,255,0.18) 0%,transparent 70%);}
  .glow-teal{background:radial-gradient(circle,rgba(20,200,176,0.15) 0%,transparent 70%);}
  .glow-coral{background:radial-gradient(circle,rgba(255,138,91,0.12) 0%,transparent 70%);}
  .mentor-card{background:#fff;border-radius:24px;box-shadow:0 8px 40px rgba(91,108,255,0.10);border:1px solid rgba(91,108,255,0.08);}
  .connect-btn{border:1.5px solid #14C8B0;color:#14C8B0;border-radius:9999px;font-size:0.75rem;font-weight:600;padding:0.35rem 1rem;transition:all 0.2s;background:#fff;cursor:pointer;}
  .connect-btn:hover{background:#14C8B0;color:#fff;}
  .tag-blue{background:#EEF0FF;color:#5B6CFF;border-radius:9999px;font-size:0.65rem;font-weight:600;padding:0.15rem 0.6rem;display:inline-block;}
  .tag-green{background:#EDFDF8;color:#14C8B0;border-radius:9999px;font-size:0.65rem;font-weight:600;padding:0.15rem 0.6rem;display:inline-block;}
  .tag-violet{background:#F3EEFF;color:#8B6DFF;border-radius:9999px;font-size:0.65rem;font-weight:600;padding:0.15rem 0.6rem;display:inline-block;}
  .hero-h1{font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(2.8rem,5vw,4.5rem);line-height:1.08;color:#0F172A;display:block;}
  .hero-accent{font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(2.8rem,5vw,4.5rem);line-height:1.08;background:linear-gradient(90deg,#5B6CFF,#8B6DFF);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;display:block;}
  .eyebrow{background:#fff;border:1px solid rgba(91,108,255,0.15);border-radius:9999px;padding:0.35rem 1rem;display:inline-flex;align-items:center;gap:0.5rem;box-shadow:0 2px 8px rgba(91,108,255,0.06);}
  .toast-card{background:#fff;border-radius:16px;box-shadow:0 8px 32px rgba(0,0,0,0.10);border:1px solid rgba(91,108,255,0.08);padding:0.75rem 1rem;display:flex;align-items:center;gap:0.75rem;}
  .avatar-circle{width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.85rem;color:#fff;flex-shrink:0;border:2px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,0.10);}
  .mentor-row{display:flex;align-items:center;gap:1rem;padding:0.85rem;border-radius:16px;border:1px solid #F1F5F9;transition:background 0.2s;}
  .mentor-row:hover{background:#F7F9FF;}
  .stat-icon{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;}
  .section-label{font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:#5B6CFF;margin-bottom:0.75rem;}
  .section-h2{font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(1.8rem,3vw,2.5rem);color:#0F172A;margin-bottom:0.5rem;}
  .grad-text{background:linear-gradient(90deg,#5B6CFF,#8B6DFF);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
  
  @keyframes moveWave {
    0% { background-position: 0 0; }
    100% { background-position: -1000px 0; }
  }
  .bg-wave-animated {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0 Q250,50 500,0 T1000,0 v120 h-1000 z' fill='rgba(91,108,255,0.03)'/%3E%3C/svg%3E");
    background-repeat: repeat-x;
    background-size: 1000px 100%;
    animation: moveWave 20s linear infinite;
  }
  .bg-wave-animated-teal {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0 Q250,50 500,0 T1000,0 v120 h-1000 z' fill='rgba(20,200,176,0.03)'/%3E%3C/svg%3E");
    background-repeat: repeat-x;
    background-size: 1000px 100%;
    animation: moveWave 25s linear infinite;
  }

  .benefit-dark{background:linear-gradient(145deg,#0F172A 0%,#1E1B4B 100%);border-radius:24px;padding:2rem;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden;}
  .benefit-card{background:#fff;border-radius:20px;padding:1.5rem;border:1px solid #F1F5F9;}
  .story-card{background:#fff;border-radius:20px;border:1px solid #F1F5F9;padding:1.5rem;}
  .cat-pill{display:flex;align-items:center;gap:0.75rem;padding:0.75rem 1.25rem;background:#fff;border-radius:16px;text-decoration:none;}
  .cat-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
</style>
@endsection

@section('content')

{{-- ===== HERO ===== --}}
<section class="hero-section relative overflow-hidden min-h-screen flex items-center" id="hero">
  <div class="absolute top-0 right-0 w-[600px] h-[600px] glow-violet pointer-events-none" style="transform:translate(20%,-20%)"></div>
  <div class="absolute bottom-0 left-0 w-96 h-96 glow-teal pointer-events-none" style="transform:translate(-30%,20%)"></div>
  <div class="absolute top-1/2 right-1/3 w-64 h-64 glow-coral pointer-events-none"></div>

  {{-- Glassy Floating Bubbles --}}
  <div class="absolute top-32 left-[10%] w-16 h-16 rounded-full bg-white/30 border border-white/50 backdrop-blur-md animate-float shadow-lg" style="animation-delay: 0s; animation-duration: 4s;"></div>
  <div class="absolute top-1/2 left-[5%] w-8 h-8 rounded-full bg-white/20 border border-white/40 backdrop-blur-sm animate-float shadow-md" style="animation-delay: 1.5s; animation-duration: 3s;"></div>
  <div class="absolute bottom-32 left-[20%] w-24 h-24 rounded-full bg-white/20 border border-white/40 backdrop-blur-md animate-float shadow-xl" style="animation-delay: 2.5s; animation-duration: 5s;"></div>
  
  <div class="absolute top-20 right-[25%] w-12 h-12 rounded-full bg-white/30 border border-white/50 backdrop-blur-sm animate-float shadow-lg" style="animation-delay: 0.5s; animation-duration: 3.5s;"></div>
  <div class="absolute bottom-40 right-[10%] w-20 h-20 rounded-full bg-white/20 border border-white/40 backdrop-blur-md animate-float shadow-xl" style="animation-delay: 1s; animation-duration: 4.5s;"></div>
  <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-primary-500/10 rounded-full blur-2xl animate-blob"></div>
  <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-secondary/10 rounded-full blur-3xl animate-blob-delay"></div>
  <div class="absolute top-10 right-1/3 w-24 h-24 bg-accent/10 rounded-full blur-2xl animate-float"></div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 relative w-full">
    <div class="grid lg:grid-cols-2 gap-16 items-center">

      {{-- LEFT --}}
      <div class="animate-fade-in-up">
        <div class="eyebrow mb-8">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1l1.5 3.5L12 5.5l-2.5 2.5.6 3.5L7 9.8 3.9 11.5l.6-3.5L2 5.5l3.5-1z" fill="#5B6CFF"/></svg>
          <span style="font-size:0.78rem;font-weight:600;color:#5B6CFF;">The bridge between startups &amp; success</span>
        </div>

        <h1 class="mb-6">
          <span class="hero-h1">Find the right</span>
          <span class="hero-accent">mentor.</span>
          <span class="hero-h1">Build the future.</span>
        </h1>

        <p style="font-size:1.05rem;color:#64748B;line-height:1.7;max-width:420px;margin-bottom:2.5rem;">
          MentorConnect helps startups connect with experienced mentors who provide guidance, insights, and support to accelerate growth.
        </p>

        <div class="flex flex-wrap gap-4 mb-14">
          <a href="{{ route('mentors.index') }}" class="btn-primary btn-shine inline-flex items-center gap-2 px-7 py-3.5 text-sm">
            <i data-lucide="search" class="w-4 h-4"></i> Find a Mentor
          </a>
          <a href="{{ route('register.startup') }}" class="btn-outline inline-flex items-center gap-2 px-7 py-3.5 text-sm">
            <i data-lucide="rocket" class="w-4 h-4" style="color:#5B6CFF"></i> Register Your Startup
          </a>
        </div>

        <div class="flex items-center gap-10">
          <div class="flex items-center gap-3">
            <div class="stat-icon" style="background:#EEF0FF;">
              <i data-lucide="users" class="w-5 h-5" style="color:#5B6CFF"></i>
            </div>
            <div>
              <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.4rem;color:#0F172A;">50+</div>
              <div style="font-size:0.75rem;color:#64748B;font-weight:500;">Expert Mentors</div>
            </div>
          </div>
          <div style="width:1px;height:40px;background:#E2E8F0;"></div>
          <div class="flex items-center gap-3">
            <div class="stat-icon" style="background:#EDFDF8;">
              <i data-lucide="building-2" class="w-5 h-5" style="color:#14C8B0"></i>
            </div>
            <div>
              <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.4rem;color:#0F172A;">120+</div>
              <div style="font-size:0.75rem;color:#64748B;font-weight:500;">Startups Helped</div>
            </div>
          </div>
          <div style="width:1px;height:40px;background:#E2E8F0;"></div>
          <div class="flex items-center gap-3">
            <div class="stat-icon" style="background:#FFF5F0;">
              <i data-lucide="grid-3x3" class="w-5 h-5" style="color:#FF8A5B"></i>
            </div>
            <div>
              <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.4rem;color:#0F172A;">10+</div>
              <div style="font-size:0.75rem;color:#64748B;font-weight:500;">Categories</div>
            </div>
          </div>
        </div>
      </div>

      {{-- RIGHT --}}
      <div class="hidden lg:block animate-fade-in-up-delay-1">
        <div class="relative" style="padding:24px 24px 24px 8px;">

          {{-- Paper plane decoration --}}
          <div class="absolute -top-6 right-12 opacity-20 pointer-events-none">
            <svg width="56" height="56" viewBox="0 0 60 60" fill="none"><path d="M5 30L55 5L40 55L28 35L5 30Z" stroke="#8B6DFF" stroke-width="2" fill="none"/><path d="M28 35L40 22" stroke="#8B6DFF" stroke-width="2"/></svg>
          </div>

          {{-- Mentor card --}}
          <div class="mentor-card p-7">
            <div class="flex items-center gap-2 mb-6">
              <svg width="16" height="16" viewBox="0 0 14 14" fill="none"><path d="M7 1l1.5 3.5L12 5.5l-2.5 2.5.6 3.5L7 9.8 3.9 11.5l.6-3.5L2 5.5l3.5-1z" fill="#F59E0B"/></svg>
              <span style="font-size:0.85rem;font-weight:700;color:#0F172A;">Top Mentor Matches for You</span>
            </div>

            <div style="display:flex;flex-direction:column;gap:0.75rem;">
              {{-- Rahul Sharma --}}
              <div class="mentor-row hover-lift">
                <div class="avatar-circle" style="background:linear-gradient(135deg,#5B6CFF,#8B6DFF);">RS</div>
                <div style="flex:1;min-width:0;">
                  <div style="font-weight:600;font-size:0.9rem;color:#0F172A;">Rahul Sharma</div>
                  <div style="font-size:0.78rem;color:#64748B;margin-bottom:0.25rem;">Tech Strategy &bull; 12 yrs</div>
                  <span class="tag-blue">Tech Strategy</span>
                </div>
                <button class="connect-btn">Connect</button>
              </div>

              {{-- Priya Patel --}}
              <div class="mentor-row hover-lift">
                <div class="avatar-circle" style="background:linear-gradient(135deg,#14C8B0,#63E6D8);">PP</div>
                <div style="flex:1;min-width:0;">
                  <div style="font-weight:600;font-size:0.9rem;color:#0F172A;">Priya Patel</div>
                  <div style="font-size:0.78rem;color:#64748B;margin-bottom:0.25rem;">Business Growth &bull; 8 yrs</div>
                  <span class="tag-green">Growth</span>
                </div>
                <button class="connect-btn">Connect</button>
              </div>

              {{-- Arjun Mehra --}}
              <div class="mentor-row hover-lift">
                <div class="avatar-circle" style="background:linear-gradient(135deg,#8B6DFF,#FF8A5B);">AM</div>
                <div style="flex:1;min-width:0;">
                  <div style="font-weight:600;font-size:0.9rem;color:#0F172A;">Arjun Mehra</div>
                  <div style="font-size:0.78rem;color:#64748B;margin-bottom:0.25rem;">Product Design &bull; 6 yrs</div>
                  <span class="tag-violet">Product</span>
                </div>
                <button class="connect-btn">Connect</button>
              </div>
            </div>

            <a href="{{ route('mentors.index') }}" style="display:flex;align-items:center;justify-content:space-between;margin-top:1.25rem;padding-top:1rem;border-top:1px solid #F1F5F9;font-size:0.82rem;font-weight:600;color:#64748B;text-decoration:none;" onmouseover="this.style.color='#5B6CFF'" onmouseout="this.style.color='#64748B'">
              <span>View all mentors</span>
              <i data-lucide="arrow-right" style="width:16px;height:16px;"></i>
            </a>
          </div>

          {{-- Floating toast --}}
          <div class="toast-card animate-float" style="position:absolute;top:-16px;right:-16px;min-width:175px;z-index:10;">
            <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#14C8B0,#63E6D8);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <i data-lucide="check" style="width:16px;height:16px;color:#fff;"></i>
            </div>
            <div>
              <div style="font-size:0.8rem;font-weight:700;color:#0F172A;">Request Sent!</div>
              <div style="font-size:0.68rem;color:#94A3B8;">Just now</div>
            </div>
          </div>

          {{-- Floating dots --}}
          <div class="animate-float" style="position:absolute;bottom:-12px;left:4px;width:18px;height:18px;border-radius:50%;background:linear-gradient(135deg,#14C8B0,#63E6D8);box-shadow:0 0 14px rgba(20,200,176,0.5);animation-delay:1s;"></div>
          <div class="animate-float" style="position:absolute;top:38%;left:-20px;width:11px;height:11px;border-radius:50%;background:#5B6CFF;opacity:0.6;animation-delay:0.5s;"></div>
        </div>
      </div>

    </div>
  </div>

  {{-- Bottom Wave Transition --}}
  <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-0 pointer-events-none">
    <svg class="relative block w-full h-[50px] lg:h-[100px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C52.16,106.9,105.15,110.5,158.4,105.7,213.4,100.8,268.4,85.6,321.39,56.44Z" fill="#F7F9FC"></path>
    </svg>
  </div>
</section>

{{-- ===== HOW IT WORKS ===== --}}
<section class="bg-surface py-24 lg:py-32" id="how-it-works">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 sm:p-12 lg:p-16 relative overflow-hidden">
      
      <!-- Header -->
      <div class="text-center mb-16 relative z-10">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-500 font-bold text-xs uppercase tracking-wider rounded-full mb-6">
          <i data-lucide="layers" class="w-4 h-4"></i>
          Simple Process
        </div>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-heading mb-4 font-display">
          How <span class="gradient-text">MentorConnect</span> Works
        </h2>
        <p class="text-body text-base lg:text-lg max-w-xl mx-auto">Connect with the right mentor in four simple steps</p>
      </div>

      <!-- Steps -->
      <div class="flex flex-col lg:flex-row justify-between items-start relative z-10 gap-10 lg:gap-0 mt-8">
        
        @php
          $steps = [
            ['num'=>'1', 'color'=>'bg-primary-500', 'shadow'=>'shadow-primary-500/20', 'icon'=>'user-plus', 'title'=>'Register', 'desc'=>'Sign up as a startup or mentor and create your profile in minutes.', 'text'=>'text-primary-500'],
            ['num'=>'2', 'color'=>'bg-secondary', 'shadow'=>'shadow-secondary/20', 'icon'=>'search', 'title'=>'Explore & Discover', 'desc'=>'Browse mentors by category, expertise, and experience to find your perfect match.', 'text'=>'text-secondary'],
            ['num'=>'3', 'color'=>'bg-accent', 'shadow'=>'shadow-accent/20', 'icon'=>'send', 'title'=>'Send Request', 'desc'=>'Send a mentorship request with your goals and what you need help with.', 'text'=>'text-accent'],
            ['num'=>'4', 'color'=>'bg-[#14C8B0]', 'shadow'=>'shadow-[#14C8B0]/20', 'icon'=>'handshake', 'title'=>'Get Mentored', 'desc'=>'Connect, collaborate, and accelerate your startup with expert guidance.', 'text'=>'text-[#14C8B0]'],
          ];
        @endphp

        @foreach($steps as $index => $step)
          <div class="w-full lg:w-48 xl:w-56 text-center flex flex-col items-center relative group">
            
            <!-- Icon Card -->
            <div class="relative mb-8">
              <!-- Number badge -->
              <div class="absolute -top-3 -left-3 w-8 h-8 rounded-full {{ $step['color'] }} text-white text-sm font-bold flex items-center justify-center shadow-lg z-10 border-2 border-white">
                {{ $step['num'] }}
              </div>
              
              <!-- White card -->
              <div class="w-24 h-24 bg-white rounded-3xl shadow-xl {{ $step['shadow'] }} flex items-center justify-center transition-transform duration-300 group-hover:-translate-y-2">
                <i data-lucide="{{ $step['icon'] }}" class="w-10 h-10 {{ $step['text'] }}" stroke-width="1.5"></i>
              </div>
            </div>

            <!-- Text -->
            <h3 class="text-lg font-bold text-heading mb-3 font-display">{{ $step['title'] }}</h3>
            <p class="text-sm text-body leading-relaxed px-2">{{ $step['desc'] }}</p>
          </div>


        @endforeach

      </div>

      <!-- Stats Row -->
      <div class="mt-20 bg-gray-50/80 rounded-3xl p-6 sm:p-8 lg:p-10 border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-8 md:gap-0 relative z-10 shadow-sm">
        
        <div class="flex items-center gap-5 px-4 w-full md:w-1/3 justify-center md:justify-start">
          <div class="w-16 h-16 rounded-full bg-primary-50 flex items-center justify-center flex-shrink-0">
            <i data-lucide="users" class="w-7 h-7 text-primary-500" stroke-width="1.5"></i>
          </div>
          <div>
            <h4 class="text-2xl sm:text-3xl font-bold text-primary-600 font-display mb-1">50+</h4>
            <p class="text-sm text-body font-medium">Expert Mentors</p>
          </div>
        </div>

        <div class="hidden md:block w-px h-16 bg-gray-200"></div>

        <div class="flex items-center gap-5 px-4 w-full md:w-1/3 justify-center">
          <div class="w-16 h-16 rounded-full bg-secondary/10 flex items-center justify-center flex-shrink-0">
            <i data-lucide="bar-chart-2" class="w-7 h-7 text-secondary" stroke-width="1.5"></i>
          </div>
          <div>
            <h4 class="text-2xl sm:text-3xl font-bold text-secondary font-display mb-1">120+</h4>
            <p class="text-sm text-body font-medium">Startups Helped</p>
          </div>
        </div>

        <div class="hidden md:block w-px h-16 bg-gray-200"></div>

        <div class="flex items-center gap-5 px-4 w-full md:w-1/3 justify-center md:justify-end">
          <div class="w-16 h-16 rounded-full bg-[#14C8B0]/10 flex items-center justify-center flex-shrink-0">
            <i data-lucide="sparkles" class="w-7 h-7 text-[#14C8B0]" stroke-width="1.5"></i>
          </div>
          <div>
            <h4 class="text-2xl sm:text-3xl font-bold text-[#14C8B0] font-display mb-1">10+</h4>
            <p class="text-sm text-body font-medium">Mentorship Categories</p>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

{{-- ===== BENEFITS ===== --}}
<section class="py-24 lg:py-32 relative overflow-hidden z-0" id="benefits">
  <div class="absolute inset-0 pointer-events-none -z-10">
    <div class="absolute inset-0 bg-[#F7F9FC]"></div>
    <div class="absolute inset-0 bg-wave-animated"></div>
    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#5B6CFF 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
  </div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="grid lg:grid-cols-4 gap-6 items-stretch">
      <div class="benefit-dark">
        <div style="position:absolute;top:0;right:0;width:200px;height:200px;background:radial-gradient(circle,rgba(91,108,255,0.2),transparent 70%);pointer-events:none;"></div>
        <div>
          <p style="font-size:0.68rem;font-weight:700;color:#14C8B0;text-transform:uppercase;letter-spacing:0.12em;margin-bottom:1.5rem;">Why Startups Choose Us</p>
          <h2 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.8rem;color:#fff;line-height:1.2;margin-bottom:1rem;">Better guidance.<br>Faster growth.</h2>
          <p style="color:#94A3B8;font-size:0.85rem;line-height:1.6;margin-bottom:2rem;">Mentorship isn't just helpful — it's a competitive advantage.</p>
          <a href="{{ route('register') }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.6rem 1.25rem;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:9999px;color:#fff;font-size:0.82rem;font-weight:600;text-decoration:none;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
            Learn More <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
          </a>
        </div>
        <div style="margin-top:2rem;display:flex;justify-content:center;">
          <div style="width:64px;height:64px;border-radius:50%;background:rgba(91,108,255,0.15);display:flex;align-items:center;justify-content:center;">
            <div style="width:40px;height:40px;border-radius:50%;background:rgba(91,108,255,0.3);display:flex;align-items:center;justify-content:center;">
              <i data-lucide="rocket" style="width:20px;height:20px;color:#8B6DFF;"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="lg:col-span-3 grid sm:grid-cols-3 gap-5">
        @php
          $benefits = [
            ['icon'=>'compass','bg'=>'#EEF0FF','ic'=>'#5B6CFF','title'=>'Strategic Direction','desc'=>"Get clarity on your vision, market positioning, and growth strategy from mentors who've been there before."],
            ['icon'=>'network','bg'=>'#F3EEFF','ic'=>'#8B6DFF','title'=>'Powerful Network','desc'=>"Tap into your mentor's network of investors, partners, and industry leaders to unlock new opportunities."],
            ['icon'=>'shield-check','bg'=>'#FFF5F0','ic'=>'#FF8A5B','title'=>'Avoid Costly Mistakes','desc'=>'Learn from real-world experience and avoid common pitfalls that can set your startup back months.'],
            ['icon'=>'rocket','bg'=>'#EDFDF8','ic'=>'#14C8B0','title'=>'Faster Growth','desc'=>'Mentored startups grow 3.5x faster and raise 7x more funding than non-mentored peers.'],
            ['icon'=>'lightbulb','bg'=>'#FFFBEB','ic'=>'#F59E0B','title'=>'Fresh Perspectives','desc'=>'Get an outside view on your challenges and opportunities you might not see from within.'],
            ['icon'=>'heart-handshake','bg'=>'#FFF0F5','ic'=>'#F43F5E','title'=>'Accountability Partner','desc'=>'Stay on track with regular check-ins and a partner who genuinely cares about your success.'],
          ];
        @endphp
        @foreach($benefits as $b)
        <div class="benefit-card group hover-lift shadow-sm">
          <div style="width:48px;height:48px;border-radius:14px;background:{{ $b['bg'] }};display:flex;align-items:center;justify-content:center;margin-bottom:1rem;transition:transform 0.2s;" class="group-hover:scale-110">
            <i data-lucide="{{ $b['icon'] }}" style="width:22px;height:22px;color:{{ $b['ic'] }};"></i>
          </div>
          <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9rem;color:#0F172A;margin-bottom:0.5rem;">{{ $b['title'] }}</h3>
          <p style="font-size:0.78rem;color:#64748B;line-height:1.6;">{{ $b['desc'] }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

{{-- ===== SUCCESS STORIES ===== --}}
<section class="bg-white py-24 lg:py-32 relative overflow-hidden z-0">
  <div class="absolute inset-0 pointer-events-none -z-10 overflow-hidden">
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary-500/10 rounded-full blur-3xl mix-blend-multiply"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-accent/10 rounded-full blur-3xl mix-blend-multiply"></div>
  </div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="text-center mb-14">
      <p class="section-label">Real Impact</p>
      <h2 class="section-h2">Success <span class="grad-text">Stories</span></h2>
      <p style="color:#64748B;">Real outcomes from mentor&ndash;startup partnerships</p>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
      @php
        $stories = [
          ['startup'=>'NovaTech','mentor'=>'Priya Sharma','metric'=>'3x revenue in 8 months','quote'=>'Our mentor helped us refine our GTM strategy and close our first enterprise deals.','bg'=>'#EEF0FF','ic'=>'#5B6CFF','icon'=>'trending-up','mc'=>'#5B6CFF'],
          ['startup'=>'GreenCart','mentor'=>'Rahul Mehta','metric'=>'Raised $500K seed','quote'=>'The pitch feedback and investor introductions were game-changing for our fundraising round.','bg'=>'#EDFDF8','ic'=>'#14C8B0','icon'=>'dollar-sign','mc'=>'#14C8B0'],
          ['startup'=>'HealthBridge','mentor'=>'Anita Desai','metric'=>'10K users in 6 months','quote'=>'We went from idea to MVP with clear product milestones thanks to weekly mentor sessions.','bg'=>'#FFF5F0','ic'=>'#FF8A5B','icon'=>'heart','mc'=>'#FF8A5B'],
        ];
      @endphp
      @foreach($stories as $s)
      <div class="story-card hover-lift shadow-sm">
        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;">
          <div style="width:40px;height:40px;border-radius:12px;background:{{ $s['bg'] }};display:flex;align-items:center;justify-content:center;">
            <i data-lucide="{{ $s['icon'] }}" style="width:18px;height:18px;color:{{ $s['ic'] }};"></i>
          </div>
          <div>
            <p style="font-weight:700;font-size:0.88rem;color:#0F172A;">{{ $s['startup'] }}</p>
            <p style="font-size:0.72rem;color:#94A3B8;">&times; {{ $s['mentor'] }}</p>
          </div>
        </div>
        <p style="font-weight:700;font-size:0.85rem;color:{{ $s['mc'] }};margin-bottom:0.75rem;">{{ $s['metric'] }}</p>
        <p style="font-size:0.82rem;color:#64748B;line-height:1.6;font-style:italic;">&ldquo;{{ $s['quote'] }}&rdquo;</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ===== CATEGORIES ===== --}}
<section class="py-20 lg:py-28 relative overflow-hidden z-0" id="categories">
  <div class="absolute inset-0 pointer-events-none -z-10">
    <div class="absolute inset-0 bg-[#F7F9FC]"></div>
    {{-- Top Inverted Wave --}}
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none transform rotate-180">
      <svg class="relative block w-full h-[40px] lg:h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
          <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C52.16,106.9,105.15,110.5,158.4,105.7,213.4,100.8,268.4,85.6,321.39,56.44Z" fill="#FFFFFF"></path>
      </svg>
    </div>
    <div class="absolute top-1/2 left-0 w-full h-1/2 bg-wave-animated-teal"></div>
    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#14C8B0 1.5px, transparent 1.5px); background-size: 32px 32px;"></div>
  </div>
  
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="text-center mb-12">
      <p class="section-label">Browse Categories</p>
      <h2 class="section-h2">Explore by <span class="grad-text">Expertise</span></h2>
      <p style="color:#64748B;">Find mentors across diverse domains</p>
    </div>
    <div class="flex flex-wrap justify-center gap-4">
      @php
        $cats = [
          ['name'=>'Technology','icon'=>'code-2','count'=>'12 Mentors','bg'=>'#EEF0FF','ic'=>'#5B6CFF','border'=>'rgba(91,108,255,0.15)'],
          ['name'=>'Marketing','icon'=>'megaphone','count'=>'8 Mentors','bg'=>'#FFF0F5','ic'=>'#F43F5E','border'=>'rgba(244,63,94,0.15)'],
          ['name'=>'Finance','icon'=>'indian-rupee','count'=>'6 Mentors','bg'=>'#EDFDF8','ic'=>'#14C8B0','border'=>'rgba(20,200,176,0.15)'],
          ['name'=>'Product Design','icon'=>'palette','count'=>'9 Mentors','bg'=>'#F3EEFF','ic'=>'#8B6DFF','border'=>'rgba(139,109,255,0.15)'],
          ['name'=>'Operations','icon'=>'settings','count'=>'7 Mentors','bg'=>'#FFFBEB','ic'=>'#F59E0B','border'=>'rgba(245,158,11,0.15)'],
          ['name'=>'Legal','icon'=>'scale','count'=>'5 Mentors','bg'=>'#EEF0FF','ic'=>'#5B6CFF','border'=>'rgba(91,108,255,0.15)'],
          ['name'=>'Sales','icon'=>'bar-chart-3','count'=>'6 Mentors','bg'=>'#EDFDF8','ic'=>'#14C8B0','border'=>'rgba(20,200,176,0.15)'],
          ['name'=>'HR & Culture','icon'=>'heart','count'=>'4 Mentors','bg'=>'#FFF0F5','ic'=>'#F43F5E','border'=>'rgba(244,63,94,0.15)'],
        ];
      @endphp
      @foreach($cats as $cat)
      <a href="{{ route('mentors.index') }}" class="cat-pill hover-lift shadow-sm" style="border:1px solid {{ $cat['border'] }};">
        <div class="cat-icon" style="background:{{ $cat['bg'] }};">
          <i data-lucide="{{ $cat['icon'] }}" style="width:16px;height:16px;color:{{ $cat['ic'] }};"></i>
        </div>
        <div>
          <div style="font-weight:700;font-size:0.85rem;color:#0F172A;">{{ $cat['name'] }}</div>
          <div style="font-size:0.72rem;color:#94A3B8;">{{ $cat['count'] }}</div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>

{{-- ===== CTA ===== --}}
<section style="background:linear-gradient(135deg,#0F172A 0%,#1E1B4B 100%);" class="py-16 lg:py-20">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
      <div>
        <h2 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(1.5rem,2.5vw,2rem);color:#fff;margin-bottom:0.5rem;">Ready to accelerate your startup?</h2>
        <p style="color:#94A3B8;font-size:0.88rem;">Join thousands of founders who are building the future with the right guidance.</p>
      </div>
      <div class="flex flex-wrap gap-4 flex-shrink-0">
        <a href="{{ route('register.startup') }}" class="btn-primary btn-shine inline-flex items-center gap-2 px-6 py-3 text-sm">
          <i data-lucide="building-2" class="w-4 h-4"></i> Register as Startup
        </a>
        <a href="{{ route('register.mentor') }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.75rem 1.5rem;background:rgba(255,255,255,0.08);border:1.5px solid rgba(255,255,255,0.2);border-radius:9999px;color:#fff;font-size:0.875rem;font-weight:600;text-decoration:none;transition:background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
          <i data-lucide="graduation-cap" class="w-4 h-4"></i> Become a Mentor
        </a>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>lucide.createIcons();</script>
@endsection
