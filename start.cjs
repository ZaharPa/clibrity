const { spawn } = require('child_process');

const processes = [
    { cmd: 'C:\\Users\\Zakhar\\.config\\herd-lite\\bin\\php.exe', args: ['artisan', 'serve'] },
    { cmd: 'C:\\Users\\Zakhar\\.config\\herd-lite\\bin\\php.exe', args: ['artisan', 'reverb:start', '--host=127.0.0.1', '--port=6001'] },
    { cmd: 'C:\\Users\\Zakhar\\.config\\herd-lite\\bin\\php.exe', args: ['artisan', 'queue:work'] },
    { cmd: 'C:\\"Program Files"\\nodejs\\npm.cmd', args: ['run', 'dev'] },
];

processes.forEach(proc => {
    const child = spawn(proc.cmd, proc.args, { stdio: 'inherit', shell: true });

    child.on('error', (err) => {
        console.error(`Failed to start process: ${proc.cmd} ${proc.args.join(' ')}`);
        console.error(err);
    });
});
