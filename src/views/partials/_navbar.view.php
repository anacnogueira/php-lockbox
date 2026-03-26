<div class="navbar shadow-sm">
    <div class="flex-1">
        <a href="/notas" class="btn btn-ghost text-xl">LockBox</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            <?php if (session()->get('show')): ?>
                <li><a href="/esconder"><i class="fa-solid fa-eye-slash"></i></a></li>
            <?php else: ?>
                 <li><a href="/confirmar"><i class="fa-solid fa-eye"></i></a></li>
            <?php endif; ?>

            <li>
                <details>
                    <summary><?= auth()->nome ?></summary>
                    <ul class="bg-base-100 rounded-t-none p-2">
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                </details>
            </li>
        </ul>
    </div>
</div>