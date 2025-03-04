import { Reciter as TypeReciter } from '@/types';
import { Download } from 'lucide-react';
import { Button } from 'react-aria-components';

const Reciter = ({ reciter }: { reciter: TypeReciter }) => {
    return (
        <div className="flex h-20 items-center justify-between gap-2 overflow-hidden rounded-md bg-white p-2">
            <div className="text-sm font-semibold text-gray-700">{reciter.name}</div>
            <div className="">
                <Button className="w-fit cursor-pointer rounded-full p-1 outline-0">
                    <Download className="h-5 w-5 text-gray-500 hover:text-gray-700 has-focus:text-gray-700" />
                </Button>
            </div>
        </div>
    );
};

export default Reciter;
