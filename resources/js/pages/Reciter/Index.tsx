import Reciter from '@/components/Reciters/Reciter';
import { Reciter as TypeReciter } from '@/types';
import { usePage } from '@inertiajs/react';

const Page = () => {
    const { reciters } = usePage<{ reciters: TypeReciter[] }>().props;

    return (
        <div className="min-h-screen w-full bg-gray-100">
            <div className="container mx-auto px-4 py-8 sm:px-6 lg:px-8">
                <h1 className="text-4xl font-semibold">Reciters</h1>

                <div className="mt-5 grid gap-4 sm:grid-cols-2 md:grid-cols-4">
                    {reciters.map((reciter) => (
                        <Reciter reciter={reciter} />
                    ))}
                </div>
            </div>
        </div>
    );
};

export default Page;
