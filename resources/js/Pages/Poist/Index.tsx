import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Pagination from "@/Components/Pagination";
import { Head, Link, useForm, usePage } from "@inertiajs/react";
import { Inertia } from "@inertiajs/inertia";
import { PageProps } from "@/types";
import { useState } from "react";
export default function Post(
    { auth, posts, search, totalData }: PageProps,
    props: any
) {
    const { data, setData, errors, post } = useForm({
        search: search || "",
    });

    function handleSearch(e: any) {
        e.preventDefault();
        Inertia.get(route("posts.index"), {
            search: data.search,
        });
    }
    return (
        <>
            <AuthenticatedLayout
                user={auth.user}
                header={
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Daftar Post (Total:{" "}
                        {new Intl.NumberFormat().format(totalData)})
                    </h2>
                }
            >
                <Head title="Post" />

                <div className="py-12">
                    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div className="p-6 text-gray-900 dark:text-gray-100">
                                <Link
                                    href={route("posts.create")}
                                    className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                >
                                    Tambah Post
                                </Link>
                                {/* form search */}
                                <div className="flex flex-col mt-4">
                                    <div className="mb-4">
                                        <label className="">Search</label>
                                        <input
                                            type="text"
                                            className="w-full px-4 py-2"
                                            name="search"
                                            value={data.search}
                                            onChange={(e) =>
                                                setData(
                                                    "search",
                                                    e.target.value
                                                )
                                            }
                                        />
                                    </div>
                                    <div className="mb-0">
                                        <button
                                            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                            onClick={handleSearch}
                                        >
                                            Search
                                        </button>
                                    </div>
                                </div>
                                {/* end form search */}
                                <table className="table-auto w-full">
                                    <thead>
                                        <tr>
                                            <th className="px-4 py-2">Judul</th>
                                            <th className="px-4 py-2">
                                                Konten
                                            </th>
                                            <th className="px-4 py-2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {posts.data.map((post: any) => (
                                            <tr key={post.id}>
                                                <td className="border px-4 py-2">
                                                    {post.title}
                                                </td>
                                                <td className="border px-4 py-2">
                                                    {post.description}
                                                </td>
                                                <td className="border px-4 py-2">
                                                    <Link
                                                        href={route(
                                                            "posts.edit",
                                                            post.id
                                                        )}
                                                        className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                                    >
                                                        Edit
                                                    </Link>
                                                </td>
                                            </tr>
                                        ))}
                                        <Pagination
                                            links={posts.links}
                                            search={data.search}
                                        />

                                        {posts.data.length === 0 && (
                                            <tr>
                                                <td
                                                    colSpan={3}
                                                    className="border px-4 py-2 text-center"
                                                >
                                                    Tidak ada data
                                                </td>
                                            </tr>
                                        )}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </AuthenticatedLayout>
        </>
    );
}
