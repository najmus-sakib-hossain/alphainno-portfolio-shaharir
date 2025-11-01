@extends('layouts.app')

@section('title', 'Add New Philosophical Logic')

@push('styles')
<style>
:root {
    --color-bg-card: #1e1e1e;
    --color-text-light: #e0e0e0;
    --color-accent-blue: #0d6efd;
    --color-accent-green: #2ecc71;
    --color-accent-red: #ef4444;
    --color-border: #333;
    --color-shadow: rgba(0,0,0,0.5);
}

.card {
    background-color: var(--color-bg-card);
    border-radius: 1rem;
    box-shadow: 0 6px 20px var(--color-shadow);
    border: 1px solid var(--color-border);
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}

.card-header {
    background-color: var(--color-bg-card);
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
    padding: 1rem 1.5rem;
    text-align: center;
    font-weight: 600;
    font-size: 1.2rem;
    color: var(--color-accent-blue);
    border-bottom: 1px solid var(--color-border);
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
    font-weight: 300;
    margin-bottom: 1rem;
}

.form-control-dark::placeholder {
    color: #777;
}

.btn-add, .btn-submit, .btn-back {
    font-weight: 600;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.btn-add {
    background-color: var(--color-accent-blue);
    color: #fff;
}

.btn-add:hover {
    background-color: #0b5ed7;
    transform: scale(1.05);
}

.btn-submit {
    background-color: var(--color-accent-green);
    color: #fff;
}

.btn-submit:hover {
    background-color: #27ae60;
}

.btn-back {
    background-color: #6c757d;
    color: #fff;
}

.btn-back:hover {
    background-color: #5c636a;
}

/* Delete button */
.btn-remove {
    background-color: #2c2c2c;
    color: var(--color-accent-red);
    border: 1px solid #333;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-remove:hover {
    background-color: var(--color-accent-red);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(239,68,68,0.35);
}
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card p-4">
                <div class="card-header">
                    <i class="bi bi-lightbulb me-2"></i> Add New Philosophical Logic
                </div>

                <form action="{{ route('philosophies.store') }}" method="POST">
                    @csrf

                    {{-- Logic Theory Input --}}
                    <div class="mb-4">
                        <label for="logic_theory" class="form-label-dark">Logic Theory</label>
                        <input type="text" name="logic_theory" id="logic_theory" class="form-control-dark"
                               placeholder="Enter main logic theory" required>
                    </div>

                    {{-- Logic Inputs --}}
                    <div id="logicWrapper">
                        <div class="logic-group mb-3 d-flex align-items-center gap-2">
                            <input type="text" name="logics[]" class="form-control-dark flex-grow-1" placeholder="Enter Logic #1" required>
                        </div>
                    </div>

                    <div class="text-end mb-4">
                        <button type="button" id="addLogicBtn" class="btn btn-add btn-sm">
                            <i class="bi bi-plus-circle me-1"></i> Add Logic
                        </button>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('philosophies.index') }}" class="btn btn-back px-4">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-submit px-4">
                            <i class="bi bi-check-circle me-1"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript for Dynamic Logic Fields --}}
@push('scripts')
<script>
    let logicCount = 1;
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
            updateLabels();
        });
    });

    function updateLabels() {
        const groups = document.querySelectorAll('.logic-group');
        groups.forEach((group, index) => {
            const input = group.querySelector('input');
            input.placeholder = `Enter Logic #${index + 1}`;
        });
        logicCount = groups.length;
    }
</script>
@endpush
@endsection
