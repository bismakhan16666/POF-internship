<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div style="max-width: 800px; margin: 40px auto; padding: 20px;">

        <!-- Welcome Card -->
        <div style="background: rgba(255,255,255,0.04); backdrop-filter: blur(20px); border-radius: 24px; border: 1px solid rgba(255,255,255,0.06); padding: 40px 35px; box-shadow: 0 20px 60px rgba(0,0,0,0.5); text-align: center;">
            
            <div style="font-size: 4rem; margin-bottom: 15px;">👋</div>
            <h1 style="font-size: 2rem; font-weight: 700; color: #fff; margin: 0;">
                Welcome, {{ Auth::user()->name }}!
            </h1>
            <p style="color: rgba(255,255,255,0.4); font-size: 1rem; margin-top: 8px;">
                You are logged in to your dashboard
            </p>

            <div style="margin-top: 25px; display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                <a href="/students" 
                   style="padding: 12px 30px; border-radius: 50px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; background: linear-gradient(135deg, #667eea, #764ba2); color: #fff; box-shadow: 0 8px 30px rgba(102,126,234,0.3); display: inline-block;"
                   onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 40px rgba(102,126,234,0.4)'"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 30px rgba(102,126,234,0.3)'">
                    📋 View Students
                </a>
                <a href="/students/create" 
                   style="padding: 12px 30px; border-radius: 50px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; background: linear-gradient(135deg, #38ef7d, #11998e); color: #fff; box-shadow: 0 8px 30px rgba(56,239,125,0.3); display: inline-block;"
                   onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 40px rgba(56,239,125,0.4)'"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 30px rgba(56,239,125,0.3)'">
                    ➕ Add Student
                </a>
            </div>
        </div>

        <!-- User Info Card -->
        <div style="margin-top: 20px; background: rgba(255,255,255,0.02); backdrop-filter: blur(10px); border-radius: 16px; border: 1px solid rgba(255,255,255,0.04); padding: 20px 25px; text-align: center;">
            <p style="color: rgba(255,255,255,0.3); font-size: 0.85rem;">
                Logged in as <strong style="color: rgba(255,255,255,0.7);">{{ Auth::user()->email }}</strong> 
                <span style="color: rgba(255,255,255,0.15); margin: 0 10px;">•</span>
                Member since {{ Auth::user()->created_at->format('M d, Y') }}
            </p>
        </div>
    </div>
</x-app-layout>