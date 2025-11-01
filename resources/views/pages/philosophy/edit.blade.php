@extends('layouts.app')

@section('title', 'Edit Philosophical Logic')

@push('styles')
<style>
:root {
    --color-bg-primary: #121212;
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-text-accent: #f0f0f0;
    --color-accent-green: #2ecc71;
    --color-accent-yellow: #f59e0b;
    --color-accent-red: #ef4444;
    --color-border: #333333;
    --color-shadow: rgba(0, 0, 0, 0.5);
}

body {
    background-color: var(--color-bg-primary);
    font-family: 'Inter', sans-serif;
}

.content-area {
    padding: 2rem;
    min-height: 100vh;
}

.card-dark {
    background-color: var(--color-bg-card);
    border-radius: 12px;
    border: 1px solid var(--color-border);
    box-shadow: 0 10px 30px var(--color-shadow);
    transition: transform 0.2s ease-in-out, box-shadow 0.3s ease;
}

.card-dark:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px var(--color-shadow);
}

.card-header-dark {
    background-color: #1a1a1a;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 15px 20px;
    font-weight: 600;
    color: var(--color-text-accent);
    font-size: 1.25rem;
    text-align: center;
}

.form-label-dark {
    color: var(--color-text-light);
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: block;
}

.form-control-dark {
    width: 100%;
    background-color: #2c2c2c;
    color: var(--color-text-light);
    border: 1px solid var(--color-border);
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 0.95rem;
    margin-bottom: 1rem;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.form-control-dark:focus {
    background-color: #2c2c2c;
    border-color: var(--color-accent-green);
    box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.3);
    outline: none;
}

.btn-modern-green,
.btn-modern-yellow,
.btn-modern-red {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 7px 18px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    text-decoration: none;
    border: none;
}

.btn-modern-green {
    background-color: var(--color-accent-green);
    color: #fff;
}

.btn-modern-green:hover {
    background-color: #27ae60;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(46, 204, 113, 0.35);
}

.btn-modern-yellow {
    background-color: var(--color-accent-yellow);
    color: #212529;
}

.btn-modern-yellow:hover {
    background-color: #d97706;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(245, 158, 11, 0.35);
}

.btn-modern-red {
    background-color: var(--color-accent-red);
    color: #fff;
}

.btn-modern-red:hover {
    background-color: #b91c1c;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(239, 68, 68, 0.35);
}

.logic-group {
    position: relative;
}

.btn-remove {
    background-color: var(--color-accent-red);
    color: #fff;
    border-radius: 6px;
    padding: 6px 10px;
    transition: all 0.3s ease;
}

.btn-remove:hover {
    background-color: #b91c1c;
    transform: translateY(-1px);
}

.btn-remove {
    background-color: #2c2c2c;
    color: #ef4444;
    border: 1px solid #333;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    padding: 0;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.btn-remove:hover {
    background-color: #ef4444;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(239, 68, 68, 0.35);
}

</style>
@endpush

@section('content')
<div class="content-area">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card-dark p-4">
                <div class="card-header-dark mb-4">
                    <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Philosophical Logic</h4>
                </div>

                <form action="{{ route('philosophies.update', $philosophy->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Logic Theory --}}
                    <div class="mb-3">
                        <label for="logic_theory" class="form-label-dark">Logic Theory</label>
                        <input type="text" name="logic_theory" id="logic_theory" class="form-control-dark"
                            value="{{ old('logic_theory', $philosophy->logic_theory) }}" required>
                    </div>

                    {{-- Logic Inputs --}}
                    {{-- Logic Inputs --}}
<div id="logicWrapper">
    @foreach(old('logics', $philosophy->logics) as $index => $logic)
        <div class="logic-group mb-3 d-flex align-items-center gap-2">
            <input type="text" name="logics[]" class="form-control-dark flex-grow-1" value="{{ $logic }}" placeholder="Enter Logic #{{ $index + 1 }}" required>
            @if($index > 0)
                <button type="button" class="btn-remove d-flex align-items-center justify-content-center">
                    <i class="bi bi-trash"></i>
                </button>
            @endif
        </div>
    @endforeach
</div>


                    <div class="text-end mb-4">
                        <button type="button" id="addLogicBtn" class="btn-modern-yellow btn-sm">
                            <i class="bi bi-plus-circle me-1"></i> Add Logic
                        </button>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('philosophies.index') }}" class="btn-modern-red"><i class="bi bi-arrow-left-circle me-1"></i> Back</a>
                        <button type="submit" class="btn-modern-green"><i class="bi bi-check-circle me-1"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let logicCount = document.querySelectorAll('.logic-group').length;
    const logicWrapper = document.getElementById('logicWrapper');
    const addLogicBtn = document.getElementById('addLogicBtn');

    addLogicBtn.addEventListener('click', () => {
        logicCount++;
        const logicGroup = document.createElement('div');
        logicGroup.classList.add('logic-group', 'mb-3', 'd-flex', 'align-items-center', 'gap-2');
        logicGroup.innerHTML = `
            <input type="text" name="logics[]" class="form-control-dark flex-grow-1" placeholder="Enter Logic #${logicCount}" required>
            <button type="button" class="btn-remove"><i class="bi bi-trash"></i></button>
        `;
        logicWrapper.appendChild(logicGroup);

        logicGroup.querySelector('.btn-remove').addEventListener('click', () => {
            logicGroup.remove();
            updateLogicLabels();
        });
    });

    function updateLogicLabels() {
        const groups = document.querySelectorAll('.logic-group input');
        groups.forEach((input, index) => {
            input.placeholder = `Enter Logic #${index + 1}`;
        });
        logicCount = groups.length;
    }

    document.querySelectorAll('.btn-remove').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.target.closest('.logic-group').remove();
            updateLogicLabels();
        });
    });
</script>
@endpush
