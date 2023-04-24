import { PaginationLink } from "@/types";
import { Link } from "@inertiajs/react";
export default function Pagination({
    links,
    search,
}: {
    links: PaginationLink[];
    search: string | null;
}) {
    function getClassName(active: boolean): string {
        if (active) {
            return "mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary bg-blue-700 text-white";
        } else {
            return "mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary";
        }
    }
    console.log("Pagination");

    console.log(links);

    return (
        <div className="flex flex-wrap justify-center">
            {links.map((link) => {
                return (
                    <Link
                        key={link.label}
                        href={link.url + (search ? "&search=" + search : "")}
                        className={getClassName(link.active)}
                    >
                        {link.label}
                    </Link>
                );
            })}
        </div>
    );
}
