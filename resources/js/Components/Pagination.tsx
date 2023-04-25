import { PageProps } from "@/types";
import { Link } from "@inertiajs/react";
export default function Pagination({
    perPage,
    currentPage,
    totalData,
    lastPage,
    params,
}: {
    perPage: number;
    currentPage: number;
    totalData: number;
    lastPage: number;
    params: string | null;
}) {
    function getClassName(active: boolean): string {
        if (active) {
            return "mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary bg-blue-700 text-white";
        } else {
            return "mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary";
        }
    }

    return (
        // <nav
        //     className="flex items-center justify-between pt-4"
        //     aria-label="Table navigation"
        // >
        //     <span className="text-sm font-normal text-gray-500 dark:text-gray-400">
        //         Showing{" "}
        //         <span className="font-semibold text-gray-900 dark:text-white">
        //             {new Intl.NumberFormat().format(perPage * currentPage)}
        //         </span>{" "}
        //         of{" "}
        //         <span className="font-semibold text-gray-900 dark:text-white">
        //             {new Intl.NumberFormat().format(totalData)}
        //         </span>
        //     </span>
        //     <ul className="inline-flex items-center -space-x-px">
        //         <li>
        //             <a
        //                 href="#"
        //                 className="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        //             >
        //                 <span className="sr-only">Previous</span>
        //                 <svg
        //                     className="w-5 h-5"
        //                     aria-hidden="true"
        //                     fill="currentColor"
        //                     viewBox="0 0 20 20"
        //                     xmlns="http://www.w3.org/2000/svg"
        //                 >
        //                     <path
        //                         fill-rule="evenodd"
        //                         d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
        //                         clip-rule="evenodd"
        //                     ></path>
        //                 </svg>
        //             </a>
        //         </li>
        //         <li>
        //             <a
        //                 href="#"
        //                 className="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        //             >
        //                 1
        //             </a>
        //         </li>
        //         <li>
        //             <a
        //                 href="#"
        //                 className="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        //             >
        //                 2
        //             </a>
        //         </li>
        //         <li>
        //             <a
        //                 href="#"
        //                 aria-current="page"
        //                 className="z-10 px-3 py-2 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
        //             >
        //                 3
        //             </a>
        //         </li>
        //         <li>
        //             <a
        //                 href="#"
        //                 className="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        //             >
        //                 ...
        //             </a>
        //         </li>
        //         <li>
        //             <a
        //                 href="#"
        //                 className="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        //             >
        //                 100
        //             </a>
        //         </li>
        //         <li>
        //             <a
        //                 href="#"
        //                 className="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        //             >
        //                 <span className="sr-only">Next</span>
        //                 <svg
        //                     className="w-5 h-5"
        //                     aria-hidden="true"
        //                     fill="currentColor"
        //                     viewBox="0 0 20 20"
        //                     xmlns="http://www.w3.org/2000/svg"
        //                 >
        //                     <path
        //                         fill-rule="evenodd"
        //                         d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
        //                         clip-rule="evenodd"
        //                     ></path>
        //                 </svg>
        //             </a>
        //         </li>
        //     </ul>
        // </nav>
        <nav className="flex items-center justify-between pt-4">
            <span className="text-sm font-normal text-gray-500 dark:text-gray-400">
                Showing{" "}
                <span className="font-semibold text-gray-900 dark:text-white">
                    {new Intl.NumberFormat().format(perPage * currentPage)}
                </span>{" "}
                of{" "}
                <span className="font-semibold text-gray-900 dark:text-white">
                    {new Intl.NumberFormat().format(totalData)}
                </span>
            </span>
            <ul className="inline-flex items-center -space-x-px">
                {currentPage > 1 && (
                    <li>
                        <Link
                            href={`?page=${currentPage - 1}`}
                            className="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            <span className="sr-only">Previous</span>
                            <svg
                                className="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </Link>
                    </li>
                )}
                {/* looping total page */}

                {currentPage < lastPage && (
                    <li>
                        <Link
                            href={`?page=${currentPage + 1}`}
                            className="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            <span className="sr-only">Next</span>
                            <svg
                                className="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </Link>
                    </li>
                )}
            </ul>
        </nav>
    );
}
