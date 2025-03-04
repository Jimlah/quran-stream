import { Head } from '@inertiajs/react';

export default function Welcome() {
    return (
        <>
            <Head title="Quran Stream">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="container mx-auto">Quran Stream</div>
        </>
    );
}
