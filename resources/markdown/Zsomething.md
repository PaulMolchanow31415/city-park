# Generate a model and a FlightFactory class...
php artisan make:model Flight --factory
php artisan make:model Flight -f

# Generate a model and a FlightSeeder class...
php artisan make:model Flight --seed
php artisan make:model Flight -s

# Generate a model and a FlightController class...
php artisan make:model Flight --controller
php artisan make:model Flight -c

# Generate a model, FlightController resource class, and form request classes...
php artisan make:model Flight --controller --resource --requests
php artisan make:model Flight -crR

# Generate a model and a FlightPolicy class...
php artisan make:model Flight --policy

# Generate a model and a migration, factory, seeder, and controller...
php artisan make:model Flight -mfsc

# Shortcut to generate a model, migration, factory, seeder, policy, controller, and form requests...
php artisan make:model Flight --all

# Generate a pivot model...
php artisan make:model Member --pivot
php artisan make:model Member -p


namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LoginFormRequest;

class AuthController extends Controller {
public function login(LoginFormRequest $request) {
if (!auth()->attempt($request->validated())) {
return redirect()
->route('login')
->withErrors(['email', 'Почта или пароль указаны не верно']);
}

        return redirect()->route('home');
    }

    public function logout(): RedirectResponse {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home');
    }
}

//Route::controller(AuthController::class)->group(function () {
//    Route::post('/login', 'login')
//        ->name('login')
//        ->middleware('guest');
//    Route::delete('/logout', 'logout')
//        ->name('logout')
//        ->middleware('auth');
//});
//Route::get('/profile', [UserController::class, 'show'])->middleware('auth');

import { nextTick, reactive, ref } from 'vue';

const emit = defineEmits(['confirmed']);

defineProps({
title: {
type: String,
default: 'Confirm Password',
},
content: {
type: String,
default: 'For your security, please confirm your password to continue.',
},
button: {
type: String,
default: 'Confirm',
},
});

const confirmingPassword = ref(false);

const form = reactive({
password: '',
error: '',
processing: false,
});

const passwordInput = ref(null);

const startConfirmingPassword = () => {
axios.get(route('password.confirmation')).then(response => {
if (response.data.confirmed) {
emit('confirmed');
} else {
confirmingPassword.value = true;

            setTimeout(() => passwordInput.value.focus(), 250);
        }
    });
};

const confirmPassword = () => {
form.processing = true;

    axios.post(route('password.confirm'), {
        password: form.password,
    }).then(() => {
        form.processing = false;

        closeModal();
        nextTick().then(() => emit('confirmed'));

    }).catch(error => {
        form.processing = false;
        form.error = error.response.data.errors.password[0];
        passwordInput.value.focus();
    });
};

const closeModal = () => {
confirmingPassword.value = false;
form.password = '';
form.error = '';
};

1. Dropdown

<script>
import { defineComponent } from 'vue';

export default defineComponent({
    data() {
        return { open: false };
    },
    props: {
        trigger: {
          type: String,
          default: 'click'
        },
        align: {
            type: String,
            default: 'right',
        },
        width: {
            type: String,
            default: '48',
        },
        contentClasses: {
            type: Array,
            default: () => ['py-1', 'bg-white'],
        },
    },
    methods: {
        closeOnEscape(e) {
            if (this.open && e.key === 'Escape') {
                this.open = false;
            }
        },
    },
    mounted() { document.addEventListener('keydown', this.closeOnEscape); },
    unmounted() { document.removeEventListener('keydown', this.closeOnEscape); },
    computed: {
        widthClass() {
            return { '48': 'w-48' }[this.width.toString()];
        },
        alignmentClasses() {
            if (this.align === 'left') {
                return 'ltr:origin-top-left rtl:origin-top-right start-0';
            }

            if (this.align === 'right') {
                return 'ltr:origin-top-right rtl:origin-top-left end-0';
            }

            if (this.align === 'center') {
                return 'left-1/2 transform -translate-x-1/2';
            }

            return 'origin-top';
        },
    },
});

</script>

<template>

    <div class="relative">
        <div @click="open = !open">
            <slot name="trigger"/>
        </div>
        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="open = false"/>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div
                v-show="open"
                class="absolute z-50 mt-2 rounded-md shadow-lg"
                :class="[widthClass, alignmentClasses]"
                style="display: none;"
                @click="open = false"
            >
                <div class="rounded-md ring-1 ring-black ring-opacity-5" :class="contentClasses">
                    <slot name="content"/>
                </div>
            </div>
        </transition>
    </div>
</template>

2. TextInput

<TextInput
ref="passwordInput"
v-model="form.password"
type="password"
class="mt-1 block w-3/4"
placeholder="Password"
autocomplete="current-password"
@keyup.enter="confirmPassword"


3. PHP web

/*Route ::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
-> group(function () {
Route ::get('/secured', function () {
return Inertia ::render('Secured');
}) -> name('secured');
});*/